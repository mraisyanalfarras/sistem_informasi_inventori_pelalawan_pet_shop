@extends('admin.app')

@section('content')
<div class="container">

    <!-- Header -->
    <div class="card shadow-sm mb-4" style="background-color: #003366;" data-aos="fade-down">
        <div class="card-body">
            <h1 class="h3 text-white">Dashboard</h1>
            <p class="text-white">Selamat datang di Dashboard Admin. Kelola informasi perusahaan dengan mudah dan efisien.</p>
        </div>
    </div>

    @if($hasExpired)
    <div class="alert shadow-sm d-flex justify-content-between align-items-center"
         style="background-color: #c82333; color: #fff; border-left: 5px solid #721c24; font-weight: bold;"
         data-aos="zoom-in">
        <div>
            <i class="bx bx-error-circle me-2" style="font-size: 1.5rem;"></i>
            ⚠️ Perhatian: Ada dokumen yang status-nya sudah expired.
        </div>
        <a href="{{ route('expired.documents') }}" class="btn btn-sm btn-light text-danger fw-bold shadow-sm">
            Lihat Daftar
        </a>
    </div>
    @endif
    
    @if($simExpiringSoon->count() || $sioExpiringSoon->count() || $sirExpiringSoon->count())
    <div class="row mb-4" data-aos="zoom-in-right">
        <div class="col-12">
            <div class="card h-100 shadow border-start border-5" 
                 style="background-color: #ffecb5; border-color: #ffc107;">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center">
                        <i class="bx bx-error-circle me-3" style="font-size: 2.2rem; color: #ffc107;"></i>
                        <div>
                            <h5 class="mb-1 fw-bold text-dark">⚠️ Notifikasi Dokumen Akan Expired</h5>
                            <p class="mb-0 text-dark">
                                Ada:
                                <strong>{{ $simExpiringSoon->count() }}</strong> SIM,
                                <strong>{{ $sioExpiringSoon->count() }}</strong> SIO, dan
                                <strong>{{ $sirExpiringSoon->count() }}</strong> SIR
                                yang akan expired dalam <strong>3 bulan ke depan</strong>.
                            </p>
                        </div>
                    </div>
                    <a href="#expired-table" class="btn btn-sm btn-outline-warning fw-bold shadow-sm">
                        Lihat Daftar
                    </a>
                </div>
            </div>
        </div>
    </div>
    @endif
    

    <!-- 3 Card SIM/SIO/SIR -->
<div class="row">
    <!-- Data SIM -->
    <div class="col-lg-4 col-md-6 mb-4" data-aos="zoom-in" data-aos-delay="100">
        <div class="card h-100 shadow-sm" style="background-color: #e6f4ea;">
            <div class="card-body d-flex flex-column justify-content-between">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total Data SIM</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalSim }} SIM</div>
                    </div>
                    <i class="bx bx-id-card fa-2x text-success"></i>
                </div>
                <div class="mt-3 text-end">
                    <a href="{{ route('datasims.index') }}" class="btn btn-sm btn-success">Lihat Detail</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Data SIO -->
    <div class="col-lg-4 col-md-6 mb-4" data-aos="zoom-in" data-aos-delay="200">
        <div class="card h-100 shadow-sm" style="background-color: #fff9e6;">
            <div class="card-body d-flex flex-column justify-content-between">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Total Data SIO</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalSio }} SIO</div>
                    </div>
                    <i class="bx bx-shield fa-2x text-warning"></i>
                </div>
                <div class="mt-3 text-end">
                    <a href="{{ route('datasios.index') }}" class="btn btn-sm btn-warning text-dark">Lihat Detail</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Data SIR -->
    <div class="col-lg-4 col-md-6 mb-4" data-aos="zoom-in" data-aos-delay="300">
        <div class="card h-100 shadow-sm" style="background-color: #ffecec;">
            <div class="card-body d-flex flex-column justify-content-between">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Total Data SIR</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalSir }} SIR</div>
                    </div>
                    <i class="bx bx-bookmark fa-2x text-danger"></i>
                </div>
                <div class="mt-3 text-end">
                    <a href="{{ route('datasirs.index') }}" class="btn btn-sm btn-danger">Lihat Detail</a>
                </div>
            </div>
        </div>
    </div>
</div>


   <!-- Tabel List Expired -->
<div class="card shadow-sm mb-4" id="expired-table" data-aos="fade-up">
    <div class="card-header bg-white">
        <h6 class="m-0">Daftar Dokumen Mendekati Expired</h6>
    </div>
    <div class="card-body table-responsive">
        <table class="table table-bordered table-hover align-middle">
            <thead class="thead-light">
                <tr class="text-center">
                    <th>NIK</th>
                    <th>Nama</th>
                    <th>Jenis</th>
                    <th>Tanggal Expired</th>
                    <th>Reminder</th>
                </tr>
            </thead>
            <tbody>
                @foreach($simExpiringSoon as $sim)
                    <tr>
                        <td>{{ $sim->nik }}</td>
                        <td>{{ $sim->name }}</td>
                        <td class="text-center">
                            <span class="badge bg-success"><i class="bx bx-id-card me-1"></i>SIM</span>
                        </td>
                        <td>{{ \Carbon\Carbon::parse($sim->expire_date)->format('d-m-Y') }}</td>
                        <td class="text-center">
                            @php
                                $selisih = \Carbon\Carbon::now()->diffInDays(\Carbon\Carbon::parse($sim->expire_date), false);
                            @endphp
                            @if ($selisih > 0)
                                <span class="badge bg-warning text-dark">{{ $selisih }} hari lagi</span>
                            @elseif ($selisih === 0)
                                <span class="badge bg-danger">Expired hari ini</span>
                            @else
                                <span class="badge bg-danger">Expired {{ abs($selisih) }} hari lalu</span>
                            @endif
                        </td>
                    </tr>
                @endforeach

                @foreach($sioExpiringSoon as $sio)
                    <tr>
                        <td>{{ $sio->nik }}</td>
                        <td>{{ $sio->name }}</td>
                        <td class="text-center">
                            <span class="badge bg-warning text-dark"><i class="bx bx-shield me-1"></i>SIO</span>
                        </td>
                        <td>{{ \Carbon\Carbon::parse($sio->expire_date)->format('d-m-Y') }}</td>
                        <td class="text-center">
                            @php
                                $selisih = \Carbon\Carbon::now()->diffInDays(\Carbon\Carbon::parse($sio->expire_date), false);
                            @endphp
                            @if ($selisih > 0)
                                <span class="badge bg-warning text-dark">{{ $selisih }} hari lagi</span>
                            @elseif ($selisih === 0)
                                <span class="badge bg-danger">Expired hari ini</span>
                            @else
                                <span class="badge bg-danger">Expired {{ abs($selisih) }} hari lalu</span>
                            @endif
                        </td>
                    </tr>
                @endforeach

                @foreach($sirExpiringSoon as $sir)
                    <tr>
                        <td>{{ $sir->nik }}</td>
                        <td>{{ $sir->nama }}</td>
                        <td class="text-center">
                            <span class="badge bg-danger"><i class="bx bx-bookmark me-1"></i>SIR</span>
                        </td>
                        <td>{{ \Carbon\Carbon::parse($sir->expire_date)->format('d-m-Y') }}</td>
                        <td class="text-center">
                            @php
                                $selisih = \Carbon\Carbon::now()->diffInDays(\Carbon\Carbon::parse($sir->expire_date), false);
                            @endphp
                            @if ($selisih > 0)
                                <span class="badge bg-warning text-dark">{{ $selisih }} hari lagi</span>
                            @elseif ($selisih === 0)
                                <span class="badge bg-danger">Expired hari ini</span>
                            @else
                                <span class="badge bg-danger">Expired {{ abs($selisih) }} hari lalu</span>
                            @endif
                        </td>
                    </tr>
                @endforeach

                @if($simExpiringSoon->isEmpty() && $sioExpiringSoon->isEmpty() && $sirExpiringSoon->isEmpty())
                    <tr>
                        <td colspan="5" class="text-center text-muted">Tidak ada data yang akan expired dalam 3 bulan ke depan.</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>

</div>
@endsection
