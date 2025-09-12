@extends('app')
@section('content')
    <div class="col-lg-5">
        <div class="card border-0 rounded-3 welcome-box mb-4 position-relative overflow-hidden"
            style="background: linear-gradient(135deg, #4936F5, #6C63FF);">
            <div class="card-body p-4">
                <div class="row align-items-center">
                    <div class="col-9 col-lg-9 col-sm-6 col-xl-10 col-xxl-7">
                        <div class="pb-3">
                            <h3 class="text-white fw-bold mb-1 fs-20">
                                Selamat Datang, <span style="color: #FFE8D4;">{{ Auth::user()->name }}</span> 👋
                            </h3>
                            <p class="text-light mb-1">
                                {{ \Carbon\Carbon::now('Asia/Jakarta')->translatedFormat('l, d F Y - H:i') }} WIB
                            </p>
                            <small class="text-white-50">Semoga harimu menyenangkan! Berikut ringkasan terbaru
                                untukmu.</small>
                        </div>
                    </div>
                    <div class="col-3 col-lg-3 col-sm-6 col-xl-2 col-xxl-5">
                        <div class="welcome-img text-center text-sm-end mt-4 mt-sm-0">
                            <img src="/assets/images/dr-olivia.png" alt="welcome" class="img-fluid rounded-circle shadow-sm"
                                style="max-width: 90px;">
                        </div>
                    </div>
                </div>
            </div>
            <img src="/assets/images/shape-7.png"
                class="position-absolute top-50 end-0 translate-middle-y z-n1 h-100 opacity-25" alt="shape">
        </div>


        <div class="row g-4 align-items-stretch">
            <div class="col-sm-6 d-flex">
                <div class="card bg-primary bg-opacity-25 border-0 rounded-3 p-4 mb-4 overflow-hidden w-100">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <span class="fw-semibold text-secondary">Total Anak Diskrining</span>
                        <i class="ri-user-smile-line fs-4 text-primary"></i>
                    </div>
                    <div class="d-flex align-items-center">
                        <h3 class="fs-24 fw-bold mb-0 text-dark">{{ $totalSiswaDiSkrinning }}</h3>
                        <span
                            class="d-inline-block px-2 text-danger border border-danger rounded-pill bg-opacity-25 fs-12 fw-medium ms-2">
                            <i class="ri-arrow-up-fill"></i>
                        </span>
                    </div>
                    <small style="color:black;" class="d-block mt-2">Data diperbarui otomatis setiap saat</small>

                </div>
            </div>

            <div class="col-sm-6 d-flex">
                <div class="card bg-danger bg-opacity-25 border-0 rounded-3 p-4 mb-4 overflow-hidden w-100">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <span class="fw-semibold text-dark">7 Hari Terakhir</span>
                        <i class="ri-stethoscope-line fs-4 text-danger"></i>
                    </div>
                    <div class="d-flex align-items-center">
                        <h3 class="fs-24 fw-bold mb-0 text-dark">{{ $totalSiswaDiSkrinning7hari }}</h3>
                        <span
                            class="d-inline-block px-2 text-danger border border-danger rounded-pill bg-opacity-25 fs-12 fw-medium ms-2">
                            <i class="ri-arrow-up-fill"></i>
                        </span>
                    </div>
                    <small style="color:black;" class="d-block mt-2">Data diperbarui otomatis setiap saat</small>

                </div>
            </div>
        </div>

    </div>


    <div class="col-lg-7">
        <div class="card bg-white border-0 rounded-3 mb-4">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-3 mb-lg-30">
                    <h3 class="mb-0">Skrinning Berdasarkan Usia</h3>
                    <select id="filterAge" class="form-select month-select form-control"
                        style="background-position: right 0 center;" aria-label="Filter umur anak">
                        <option value="all" selected>Seluruh Data</option>
                        <option value="this_month">Bulan Ini</option>
                        <option value="last_month">Bulan Lalu</option>
                    </select>
                </div>

                <div style="margin-top: -9px;">
                    <div id="patient_by_age"></div>
                </div>
            </div>
        </div>
    </div>


    @if(Auth::user()->level_id == 2)
        <div class="col-lg-12">
            <div class="card bg-white border-0 rounded-3 mb-4">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-3 mb-lg-4">
                        <h3 class="mb-0">10 Data Skrinning Terbaru</h3>

                    </div>

                    <div class="default-table-area ">
                        <div class="table-responsive">
                            <table class="table align-middle">
                                <thead>
                                    <tr>
                                        <th scope="col">Anak</th>
                                        <th scope="col">Orang Tua</th>
                                        <th scope="col">Tanggal Lahir</th>
                                        <th scope="col">Formulir</th>
                                        <th scope="col">Usia</th>
                                        <th scope="col">Skor</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($topTen as $top)
                                        <tr>
                                            <td>{{ $top->nama_siswa }}</td>
                                            <td>{{ $top->nama_orangtua }}</td>
                                            <td>{{ $top->tanggal_lahir }}</td>
                                            <td>{{ $top->formulir->judul }}</td>
                                            <td>{{ $top->usia_pembulatan }}</td>
                                            <td>{{ $top->total_skor }}</td>

                                        </tr>

                                    @empty
                                    @endforelse



                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    @else
        <div class="row">
            {{-- Kolom kiri: tabel skrining --}}
            <div class="col-lg-8">
                <div class="card bg-white border-0 rounded-3 mb-4">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-3 mb-lg-4">
                            <h3 class="mb-0">10 Pendaftar Terbaru</h3>
                        </div>

                        <div class="default-table-area">
                            <div class="table-responsive">
                                <table class="table align-middle">
                                    <thead>
                                        <tr>
                                            <th scope="col">Nama</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Institusi</th>
                                            <th scope="col">Register</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($topTenRegister as $top)
                                            <tr>
                                                <td>{{ $top->name }}</td>
                                                <td>{{ $top->email }}</td>
                                                <td>{{ $top->teaching_place }}</td>
                                                <td>{{ $top->created_at->format('d M Y') }}</td>

                                        @empty
                                                <tr>
                                                    <td colspan="6" class="text-center text-muted">Belum ada data</td>
                                                </tr>
                                            @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Kolom kanan: artikel & video --}}
            <div class="col-lg-4">
                {{-- Card Jumlah Artikel --}}
                <div class="card bg-white border-0 rounded-3 shadow-sm p-4 mb-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <span class="fw-semibold text-secondary">Jumlah Pendaftar</span>
                        <i class="ri-user-fill fs-4 text-primary"></i>
                    </div>
                    <div class="d-flex align-items-center">
                        <h3 class="fs-24 fw-bold mb-0 text-dark">{{ $topTenRegister->count() ?? 0 }}</h3>
                    </div>
                    <small class="text-muted d-block mt-2">Total pendaftar</small>
                </div>

                <div class="card bg-white border-0 rounded-3 shadow-sm p-4 mb-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <span class="fw-semibold text-secondary">Jumlah Artikel</span>
                        <i class="ri-article-fill fs-4 text-danger"></i>
                    </div>
                    <div class="d-flex align-items-center">
                        <h3 class="fs-24 fw-bold mb-0 text-dark">{{ $totalArtikel ?? 0 }}</h3>
                    </div>
                    <small class="text-muted d-block mt-2">Total artikel yang sudah tersedia</small>
                </div>

                <div class="card bg-white border-0 rounded-3 shadow-sm p-4 mb-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <span class="fw-semibold text-secondary">Jumlah Video</span>
                        <i class="ri-live-fill fs-4 text-danger"></i>
                    </div>
                    <div class="d-flex align-items-center">
                        <h3 class="fs-24 fw-bold mb-0 text-dark">{{ $totalVideo ?? 0 }}</h3>
                    </div>
                    <small class="text-muted d-block mt-2">Total video yang sudah tersedia</small>
                </div>
            </div>
        </div>

    @endif


@endsection


@push('scripts')
    <script>
        $(document).ready(function () {
            function loadPatientByAge(periode) {
                $.get('/dashboard/anak-by-age', { periode: periode }, function (res) {
                    if (!res || res.length === 0) {
                        $("#patient_by_age").html(
                            '<div class="text-center text-muted py-5">Tidak ada data tersedia</div>'
                        );
                        return;
                    }

                    let labels = res.map(item => item.usia_pembulatan + " bln");
                    let values = res.map(item => item.total);

                    let options = {
                        chart: {
                            type: 'pie',
                            height: 300
                        },
                        series: values,
                        labels: labels,
                        legend: {
                            position: 'bottom'
                        },
                        tooltip: {
                            y: {
                                formatter: function (val) {
                                    return val + " anak";
                                }
                            }
                        }
                    };

                    $("#patient_by_age").html("");
                    let chart = new ApexCharts(
                        document.querySelector("#patient_by_age"),
                        options
                    );
                    chart.render();
                }).fail(function () {
                    $("#patient_by_age").html(
                        '<div class="text-center text-danger py-5">Terjadi kesalahan memuat data</div>'
                    );
                });
            }

            loadPatientByAge($('#filterAge').val());

            $('#filterAge').on('change', function () {
                loadPatientByAge($(this).val());
            });
        });

    </script>
@endpush