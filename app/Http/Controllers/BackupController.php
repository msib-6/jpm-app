<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MachineOperation;
use League\Csv\Writer;
use League\Csv\Reader;

class BackupController extends Controller
{

    //Import machine operation from CSV
    public function import(Request $request) {
        $request->validate([
            'file' => 'required|mimes:csv,txt|max:2048', // Adjust the max file size if needed
        ]);

        if ($request->hasFile('file')) {
            $file = $request->file('file');

            $csv = Reader::createFromPath($file->getPathname(), 'r');
            $csv->setHeaderOffset(0); 
            foreach ($csv as $row) {
                MachineOperation::updateOrCreate(
                    [
                        'year' => $row['year'],
                        'month' => $row['month'],
                        'week' => $row['week'],
                        'day' => $row['day'],
                        'code' => $row['code'],
                        'time' => $row['time'],
                    ],
                    [
                        'description' => $row['description'],
                        'is_changed' => $row['is_changed'],
                        'changed_by' => $row['changed_by'],
                        'change_date' => $row['change_date'],
                        'is_approved' => $row['is_approved'],
                        'approved_by' => $row['approved_by'],
                    ]
                );
            }

            return redirect()->back()->with('success', 'Data imported successfully!');
        }

        return redirect()->back()->with('error', 'File not found!');
    }

    //Export machine operation to CSV
    public function export() {
        $machineOperations = MachineOperation::all();

        $csv = Writer::createFromFileObject(new \SplTempFileObject());

        $csv->insertOne([
            'year', 'month', 'week', 'day', 'code', 'time',
            'description', 'is_changed', 'changed_by', 'change_date',
            'is_approved', 'approved_by'
        ]);

        foreach ($machineOperations as $operation) {
            $csv->insertOne([
                $operation->year, $operation->month, $operation->week, $operation->day,
                $operation->code, $operation->time, $operation->description,
                $operation->is_changed, $operation->changed_by, $operation->change_date,
                $operation->is_approved, $operation->approved_by
            ]);
        }

        $headers = array(
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="machine_operations.csv"',
        );

        return response()->stream(
            function () use ($csv) {
                $csv->output();
            },
            200,
            $headers
        );
    }
}