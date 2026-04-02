    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Sistem Monitoring Antrian Pasien Online drg. Putri Kharisma</title>
        {{-- link css cdn bootstrap --}}
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    </head>

    <body class="d-flex flex-column vh-100">
        {{-- menambahkan tampilan navbar yang dipanggil dari file lain menggunakan @include --}}
        {{-- @include('templates.navbar') --}}
        <div class="d-flex vh-100">
            @include('layouts.sidebar')
            <div class="d-flex flex-column flex-grow-1">
                @include('layouts.header')

                {{-- Konten --}}
                <main class="flex-grow-1 px-4 py-3 overflow-auto" style="background-color: #e0dada">
                    @yield('content')
                </main>

                {{-- Footer --}}
                <footer class="bg-dark text-white py-2 text-center">
                    &copy; YULIA SUHARTINI, 2025
                </footer>
            </div>
        </div>



        @yield('javascript')
        {{-- link javascript cdn bootstrap --}}
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
        <script>
            document.getElementById("perlu_kontrol").addEventListener("change", function() {
                document.getElementById("jadwal_kontrol_form").style.display = this.checked ? "block" : "none";
            });
        </script>
        
    </body>

    </html>
