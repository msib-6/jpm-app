document.getElementById('pindah-ke-bagian-2').addEventListener('click', function() {
    document.getElementById('bagian-1').classList.add('hidden');
    document.getElementById('bagian-2').classList.remove('hidden');
});

document.getElementById('kembali-ke-bagian-1').addEventListener('click', function() {
    document.getElementById('bagian-2').classList.add('hidden');
    document.getElementById('bagian-1').classList.remove('hidden');
});

document.getElementById('kembali-ke-bagian-2').addEventListener('click', function() {
    document.getElementById('bagian-3').classList.add('hidden');
    document.getElementById('bagian-2').classList.remove('hidden');
});

document.getElementById('kembali-ke-bagian-3').addEventListener('click', function() {
    document.getElementById('bagian-4').classList.add('hidden');
    document.getElementById('bagian-3').classList.remove('hidden');
});
