<!doctype html>
    <html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        @vite('resources/css/guest/dashboard.css')
    </head>
    <body>
    <div class="card h-full">
        <!--begin::Body-->
        <div class="background-guest py-0">
            <!--begin::Row-->
            <div class="flex items-center h-100">
                 <!--begin::Col-->
                <div class="w-7/12 xl:pl-10 pr-2">

                                <!-- Bagian 1 -->
                                <div id="bagian-1" class="section">
                                <div class="text-container">
                                <h3 class="text-4xl mb-8 font-bold">Welcome To JPM View (Guest Mode)</h3>
                                <p class="text-lg mb-8">Selamat datang di halaman dashboard eksklusif JPM! Di sini, Anda akan menemukan rangkuman yang komprehensif dan terperinci mengenai aktivitas operasional yang vital bagi kesuksesan bisnis Anda. Melalui visualisasi data yang intuitif dan informatif, Anda dapat dengan mudah melacak kinerja operasional, menganalisis tren, dan mengidentifikasi potensi area perbaikan.</p>
                                
                                <button type="button" id="pindah-ke-bagian-2" class="text-white bg-gradient-to-r from-cyan-500 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-cyan-300 dark:focus:ring-cyan-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 inline-flex items-center">
        Pilih Line
        <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
        </svg>
    </button>
                                <button type="button" onclick="window.location.href='/summary'" class="text-white bg-gradient-to-r from-cyan-500 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-cyan-300 dark:focus:ring-cyan-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">
                                    History
                                </button>
                            
                                </div>
                            </div>

                        <!-- Bagian 2 -->
                        <div id="bagian-2" class="section hidden">
                            <div class=" p-6">
                                <h3 class="text-3xl mb-8 font-bold">PILIH LINE</h3>
                                <div id="line-container">
                                    <!-- Line buttons will be populated here -->
                                </div>
                                <div class="logo-container self-start">
                                    <a href="#bagian-1" id="kembali-ke-bagian-1" class="text-white bg-purple-700 hover:bg-purple-800 focus:ring-4 focus:outline-none focus:ring-purple-300 font-medium rounded-lg text-sm px-12 py-2.5 text-left inline-flex items-center dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-purple-800">
                                        <svg class="rotate-180 w-3.5 h-3.5 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                                        </svg>
                                        Back
                                    </a>
                                </div>
                            </div>
                            </div>

                                <!-- Bagian 3 (Choose Year) -->
                                <div id="bagian-3" class="section hidden">
                            <div class=" p-6">
                                <h3 class="text-3xl mb-8 font-bold">PILIH YEAR</h3>
                                <div id="year-container">
                                    <!-- Line buttons will be populated here -->
                                </div>
                                <div class="logo-container self-start">
                                    <a href="#bagian-2" id="kembali-ke-bagian-2" class="text-white bg-purple-700 hover:bg-purple-800 focus:ring-4 focus:outline-none focus:ring-purple-300 font-medium rounded-lg text-sm px-12 py-2.5 text-left inline-flex items-center dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-purple-800">
                                        <svg class="rotate-180 w-3.5 h-3.5 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                                        </svg>
                                        Back
                                    </a>
                                </div>
                            </div>
                            </div>


                                <!-- Bagian 4 (Choose Month) -->
                                <div id="bagian-4" class="section hidden">
                            <div class=" p-6">
                                <h3 class="text-3xl mb-8 font-bold">PILIH MONTH</h3>
                                <div id="month-container">
                                    <!-- Line buttons will be populated here -->
                                </div>
                                <div class="logo-container self-start">
                                    <a href="#bagian-3" id="kembali-ke-bagian-3" class="text-white bg-purple-700 hover:bg-purple-800 focus:ring-4 focus:outline-none focus:ring-purple-300 font-medium rounded-lg text-sm px-12 py-2.5 text-left inline-flex items-center dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-purple-800">
                                        <svg class="rotate-180 w-3.5 h-3.5 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                                        </svg>
                                        Back
                                    </a>
                                </div>
                            </div>
                            </div>
                          </div>
                        <!--end::Col-->
                    <!--begin::Col-->
                <div class=" w-7/12 pt-5 lg:pt-15">
                <!--begin::Illustration-->
                <div class="image bg-no-repeat bg-contain bg-right-bottom" style="background-image:url('{{ asset('svg/8.svg') }}'); height: 48em; width: 48em;">
                </div>
                <!--begin::Illustration-->
              </div>
              <!--end::Col-->
            </div>
        </div>
        </div>
            <!--end::Row-->
        </div>


        <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                let selectedLine = null;
                let selectedYear = null;

                // Helper function to convert month number to Indonesian month name
                function monthName(monthNumber) {
                    const monthNames = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
                    return monthNames[monthNumber - 1];  // monthNumber - 1 because array is zero-indexed
                }

                // Event listener for 'Pilih Line' button
                document.getElementById('pindah-ke-bagian-2').addEventListener('click', function () {
                    document.getElementById('bagian-1').classList.add('hidden');
                    document.getElementById('bagian-2').classList.remove('hidden');
                    fetchLines();
                });

                // Event listeners for back buttons
                document.getElementById('kembali-ke-bagian-1').addEventListener('click', function () {
                    document.getElementById('bagian-2').classList.add('hidden');
                    document.getElementById('bagian-1').classList.remove('hidden');
                });

                document.getElementById('kembali-ke-bagian-2').addEventListener('click', function () {
                    document.getElementById('bagian-3').classList.add('hidden');
                    document.getElementById('bagian-2').classList.remove('hidden');
                    if (selectedLine) {
                        fetchLines(); // Refetch lines to ensure context remains
                    }
                });

                document.getElementById('kembali-ke-bagian-3').addEventListener('click', function () {
                    document.getElementById('bagian-4').classList.add('hidden');
                    document.getElementById('bagian-3').classList.remove('hidden');
                    if (selectedLine && selectedYear) {
                        fetchYears(selectedLine); // Refetch years to ensure context remains
                    }
                });

                // Fetch and display lines
                function fetchLines() {
                    axios.get('http://127.0.0.1:8000/api/showallmachineoperationguest')
                        .then(function (response) {
                            const lines = new Set(response.data.operations.map(machine => machine.current_line));
                            populateLines(Array.from(lines));
                        })
                        .catch(function (error) {
                            console.error('Error fetching lines:', error);
                        });
                }

                // Populate line buttons
                function populateLines(lines) {
                    const lineContainer = document.getElementById('line-container');
                    lineContainer.innerHTML = '';
                    lines.forEach(line => {
                        const button = document.createElement('button');
                        button.textContent = `${line}`;
                        button.className = 'btn w-48 h-16 text-lg ml-4 mb-4 text-left';
                        button.addEventListener('click', () => selectLine(line));
                        lineContainer.appendChild(button);
                    });
                }

                // Select line and fetch years
                function selectLine(line) {
                    selectedLine = line;
                    document.getElementById('bagian-2').classList.add('hidden');
                    document.getElementById('bagian-3').classList.remove('hidden');
                    fetchYears(line);
                }

                // Fetch and display years based on the selected line
                function fetchYears(line) {
                    axios.get(`http://127.0.0.1:8000/api/showallmachineoperationguest?line=${line}`)
                        .then(function (response) {
                            const years = new Set(response.data.operations.filter(machine => machine.current_line === line).map(machine => machine.year));
                            populateYears(Array.from(years));
                        })
                        .catch(function (error) {
                            console.error('Error fetching years:', error);
                        });
                }

                // Populate year buttons
                function populateYears(years) {
                    const yearContainer = document.getElementById('year-container');
                    yearContainer.innerHTML = '';
                    years.forEach(year => {
                        const button = document.createElement('button');
                        button.textContent = year;
                        button.className = 'btn w-48 h-16 text-lg ml-4 mb-4 text-left';
                        button.addEventListener('click', () => selectYear(year));
                        yearContainer.appendChild(button);
                    });
                }

                // Select year and fetch months
                function selectYear(year) {
                    selectedYear = year;
                    document.getElementById('bagian-3').classList.add('hidden');
                    document.getElementById('bagian-4').classList.remove('hidden');
                    fetchMonths(selectedLine, year);
                }

                // Fetch and display months based on the selected line and year
                function fetchMonths(line, year) {
                    axios.get(`http://127.0.0.1:8000/api/showallmachineoperationguest?line=${line}&year=${year}`)
                        .then(function (response) {
                            const months = new Set(response.data.operations.filter(machine => machine.current_line === line && machine.year === year).map(machine => machine.month));
                            populateMonths(Array.from(months));
                        })
                        .catch(function (error) {
                            console.error('Error fetching months:', error);
                        });
                }

                // Populate month buttons and add click handler to redirect
                function populateMonths(months) {
                    const monthContainer = document.getElementById('month-container');
                    monthContainer.innerHTML = '';
                    months.forEach(month => {
                        const button = document.createElement('button');
                        button.textContent = monthName(month);
                        button.className = 'btn w-48 h-16 text-lg ml-4 mb-4 text-left';
                        button.addEventListener('click', () => {
                            window.location.href = `/guest/viewGuest?line=${selectedLine}&year=${selectedYear}&month=${month}`;
                        });
                        monthContainer.appendChild(button);
                    });
                }
            });
        </script>
        <script>
  console.clear();
</script>
<script>
  /*! Canvallax, v1.2.1 (built 2015-11-13) https://github.com/shshaw/Canvallax.js @preserve */ ! function() {
    function a(a, b) {
      return a.zIndex === b.zIndex ? 0 : a.zIndex < b.zIndex ? -1 : 1
    }

    function b() {
      this.width = this.width ? this.width : this.image.width, this.height = this.height ? this.height : this.image.height
    }
    var c = window,
      d = document,
      e = d.documentElement,
      f = d.body,
      g = c.requestAnimationFrame || c.mozRequestAnimationFrame || c.webkitRequestAnimationFrame || c.msRequestAnimationFrame || c.oRequestAnimationFrame || function(a) {
        c.setTimeout(a, 20)
      },
      h = function() {},
      i = {
        tracking: "scroll",
        trackingInvert: !1,
        x: 0,
        y: 0,
        damping: 1,
        canvas: void 0,
        className: "",
        parent: document.body,
        elements: void 0,
        animating: !0,
        fullscreen: !0,
        preRender: h,
        postRender: h
      },
      j = !1,
      k = 0,
      l = 0,
      m = function() {
        k = e.scrollLeft || f.scrollLeft, l = e.scrollTop || f.scrollTop
      },
      n = !1,
      o = 0,
      p = 0,
      q = function(a) {
        o = a.touches ? a.touches[0].clientX : a.clientX, p = a.touches ? a.touches[0].clientY : a.clientY
      };
    if (!c.CanvasRenderingContext2D) return c.Canvallax = function() {
      return !1
    };
    c.Canvallax = function s(a) {
      if (!(this instanceof s)) return new s(a);
      var b = this;
      return s.extend(this, i, a), b.canvas = b.canvas || d.createElement("canvas"), b.canvas.className += " canvallax " + b.className, b.parent.insertBefore(b.canvas, b.parent.firstChild), b.fullscreen ? (b.resizeFullscreen(), c.addEventListener("resize", b.resizeFullscreen.bind(b))) : b.resize(b.width, b.height), b.ctx = b.canvas.getContext("2d"), b.elements = [], a && a.elements && b.addElements(a.elements), b.damping = !b.damping || b.damping < 1 ? 1 : b.damping, b.render(), b
    }, Canvallax.prototype = {
      _x: 0,
      _y: 0,
      add: function(b) {
        for (var c = b.length ? b : arguments, d = c.length, e = 0; d > e; e++) this.elements.push(c[e]);
        return this.elements.sort(a), this
      },
      remove: function(a) {
        var b = this.elements.indexOf(a);
        return b > -1 && this.elements.splice(b, 1), this
      },
      render: function() {
        var a = this,
          b = 0,
          d = a.elements.length,
          e = 0,
          f = 0,
          h = a.fullscreen || "pointer" !== a.tracking;
        for (a.animating && (a.animating = g(a.render.bind(a))), a.tracking && ("scroll" === a.tracking ? (j || (j = !0, m(), c.addEventListener("scroll", m), c.addEventListener("touchmove", m)), a.x = k, a.y = l) : "pointer" === a.tracking && (n || (n = !0, c.addEventListener("mousemove", q), c.addEventListener("touchmove", q)), h || (e = a.canvas.offsetLeft, f = a.canvas.offsetTop, h = o >= e && o <= e + a.width && p >= f && p <= f + a.height), h && (a.x = -o + e, a.y = -p + f)), a.x = !h || a.trackingInvert !== !0 && "invertx" !== a.trackingInvert ? a.x : -a.x, a.y = !h || a.trackingInvert !== !0 && "inverty" !== a.trackingInvert ? a.y : -a.y), a._x += (-a.x - a._x) / a.damping, a._y += (-a.y - a._y) / a.damping, a.ctx.clearRect(0, 0, a.width, a.height), a.preRender(a.ctx, a); d > b; b++) a.ctx.save(), a.elements[b]._render(a.ctx, a), a.ctx.restore();
        return a.postRender(a.ctx, a), this
      },
      resize: function(a, b) {
        return this.width = this.canvas.width = a, this.height = this.canvas.height = b, this
      },
      resizeFullscreen: function() {
        return this.resize(c.innerWidth, c.innerHeight)
      },
      play: function() {
        return this.animating = !0, this.render()
      },
      pause: function() {
        return this.animating = !1, this
      }
    }, Canvallax.createElement = function() {
      function a(a) {
        var c = b(a);
        return a._pointCache && a._pointChecksum === c || (a._pointCache = a.getTransformPoint(), a._pointChecksum = c), a._pointCache
      }

      function b(a) {
        return [a.transformOrigin, a.x, a.y, a.width, a.height, a.size].join(" ")
      }
      var c = Math.PI / 180,
        d = {
          x: 0,
          y: 0,
          distance: 1,
          fixed: !1,
          opacity: 1,
          fill: !1,
          stroke: !1,
          lineWidth: !1,
          transformOrigin: "center center",
          scale: 1,
          rotation: 0,
          preRender: h,
          render: h,
          postRender: h,
          init: h,
          crop: !1,
          getTransformPoint: function() {
            var a = this,
              b = a.transformOrigin.split(" "),
              c = {
                x: a.x,
                y: a.y
              };
            return "center" === b[0] ? c.x += a.width ? a.width / 2 : a.size : "right" === b[0] && (c.x += a.width ? a.width : 2 * a.size), "center" === b[1] ? c.y += a.height ? a.height / 2 : a.size : "bottom" === b[1] && (c.y += a.height ? a.height : 2 * a.size), c
          },
          _render: function(b, d) {
            var e = this,
              f = e.distance || 1,
              g = d._x,
              h = d._y,
              i = a(e);
            return e.preRender.call(e, b, d), e.blend && (d.ctx.globalCompositeOperation = e.blend), d.ctx.globalAlpha = e.opacity, d.ctx.translate(i.x, i.y), e.scale === !1 ? (g *= f, h *= f) : d.ctx.scale(f, f), e.fixed || d.ctx.translate(g, h), e.scale !== !1 && d.ctx.scale(e.scale, e.scale), e.rotation && d.ctx.rotate(e.rotation * c), d.ctx.translate(-i.x, -i.y), e.crop && (b.beginPath(), "function" == typeof e.crop ? e.crop.call(e, b, d) : b.rect(e.crop.x, e.crop.y, e.crop.width, e.crop.height), b.clip(), b.closePath()), e.outline && (b.beginPath(), b.rect(e.x, e.y, e.width || 2 * e.size, e.height || 2 * e.size), b.closePath(), b.strokeStyle = e.outline, b.stroke()), e.render.call(e, b, d), this.fill && (b.fillStyle = this.fill, b.fill()), this.stroke && (this.lineWidth && (b.lineWidth = this.lineWidth), b.strokeStyle = this.stroke, b.stroke()), e.postRender.call(e, b, d), e
          },
          clone: function(a) {
            var a = Canvallax.extend({}, this, a);
            return new this.constructor(a)
          }
        };
      return function(a) {
        function b(a) {
          return this instanceof b ? (Canvallax.extend(this, a), this.init.apply(this, arguments), this) : new b(a)
        }
        return b.prototype = Canvallax.extend({}, d, a), b.prototype.constructor = b, b.clone = b.prototype.clone, b
      }
    }(), Canvallax.extend = function(a) {
      a = a || {};
      var b = arguments.length,
        c = 1;
      for (1 === arguments.length && (a = this, c = 0); b > c; c++)
        if (arguments[c])
          for (var d in arguments[c]) arguments[c].hasOwnProperty(d) && (a[d] = arguments[c][d]);
      return a
    };
    var r = 2 * Math.PI;
    Canvallax.Circle = Canvallax.createElement({
      size: 20,
      render: function(a) {
        a.beginPath(), a.arc(this.x + this.size, this.y + this.size, this.size, 0, r), a.closePath()
      }
    }), Canvallax.Element = Canvallax.createElement(), Canvallax.Image = Canvallax.createElement({
      src: null,
      image: null,
      width: null,
      height: null,
      init: function(a) {
        this.image = this.image && 1 === this.image.nodeType ? this.image : a && 1 === a.nodeType ? a : new Image, b.bind(this)(), this.image.onload = b.bind(this), this.image.src = this.image.src || a.src || a
      },
      render: function(a) {
        this.image && a.drawImage(this.image, this.x, this.y, this.width, this.height)
      }
    });
    var r = 2 * Math.PI;
    Canvallax.Polygon = Canvallax.createElement({
      sides: 6,
      size: 20,
      render: function(a) {
        var b = this.sides;
        for (a.translate(this.x + this.size, this.y + this.size), a.beginPath(), a.moveTo(this.size, 0); b--;) a.lineTo(this.size * Math.cos(b * r / this.sides), this.size * Math.sin(b * r / this.sides));
        a.closePath()
      }
    }), Canvallax.Rectangle = Canvallax.createElement({
      width: 100,
      height: 100,
      render: function(a) {
        a.beginPath(), a.rect(this.x, this.y, this.width, this.height), a.closePath()
      }
    })
  }();
</script>
<script src="{{ asset('js/index.js') }}"></script>




    </div>
    </body>
    </html>