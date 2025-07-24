@extends('admin.app')

@section('content')
    <div class="container">
        <!-- Page Header -->
        <div class="row mb-4">
            <div class="col-12">
                <h1 class="h3">Dashboard</h1>
                <p class="text-muted">Selamat datang di Dashboard Admin. Kelola informasi perusahaan dengan mudah dan efisien.</p>
            </div>
        </div>

        <!-- Dashboard Cards -->
        <div class="row">
            <!-- Card: Departments -->
            @can('show departments')
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100 border-left-primary shadow-sm border-0">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Departemen</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">Pengelolaan Departemen</div>
                                <p class="mt-2 mb-0">Kelola struktur dan informasi departemen</p>
                            </div>
                            <div class="col-auto">
                                <i class="bx bx-building fa-2x text-primary"></i>
                            </div>
                        </div>
                        <a href="{{ route('departments.index') }}" class="btn btn-primary btn-sm mt-3">Kelola Departemen</a>
                    </div>
                </div>
            </div>
            @endcan

            <!-- Card: Employees -->
            @can('show employees') 
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100 border-left-success shadow-sm border-0">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Karyawan</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">Data Karyawan</div>
                                <p class="mt-2 mb-0">Kelola informasi dan data karyawan</p>
                            </div>
                            <div class="col-auto">
                                <i class="bx bx-user fa-2x text-success"></i>
                            </div>
                        </div>
                        <a href="{{ route('employees.index') }}" class="btn btn-success btn-sm mt-3">Kelola Karyawan</a>
                    </div>
                </div>
            </div>
            @endcan

            <!-- Card: Payroll -->
            @can('show payrolls')
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100 border-left-info shadow-sm border-0">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Payroll</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">Sistem Penggajian</div>
                                <p class="mt-2 mb-0">Kelola gaji dan tunjangan karyawan</p>
                            </div>
                            <div class="col-auto">
                                <i class="bx bx-money fa-2x text-info"></i>
                            </div>
                        </div>
                        <a href="{{ route('payroll.index') }}" class="btn btn-info btn-sm mt-3">Kelola Payroll</a>
                    </div>
                </div>
            </div>
            @endcan

            <!-- Card: Leave Requests -->
            @can('show leaves')
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100 border-left-warning shadow-sm border-0">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Cuti & Izin</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">Manajemen Cuti</div>
                                <p class="mt-2 mb-0">Kelola pengajuan cuti karyawan</p>
                            </div>
                            <div class="col-auto">
                                <i class="bx bx-calendar fa-2x text-warning"></i>
                            </div>
                        </div>
                        <a href="{{ route('leave.index') }}" class="btn btn-warning btn-sm mt-3">Kelola Cuti</a>
                    </div>
                </div>
            </div>
            @endcan

            <!-- Card: Attendance -->
            @can('show attendances')
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100 border-left-danger shadow-sm border-0">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Kehadiran</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">Absensi Karyawan</div>
                                <p class="mt-2 mb-0">Monitor kehadiran karyawan</p>
                            </div>
                            <div class="col-auto">
                                <i class="bx bx-time fa-2x text-danger"></i>
                            </div>
                        </div>
                        <a href="{{ route('attendance.index') }}" class="btn btn-danger btn-sm mt-3">Kelola Absensi</a>
                    </div>
                </div>
            </div>
            @endcan
        </div>
    </div>
@endsection
