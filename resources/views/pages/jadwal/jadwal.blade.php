{{-- Extends layout --}}
@extends('components.layout')



{{-- Content --}}
@section('content')
    <div class="col-lg-12 mb-4 order-0">
        <div class="card">
            <div class="row gy-3 m-1">
                <div class="col-md-6 d-flex align-items-end">
                    <div class="demo-inline-spacing ">
                        <h4 class="m-0">Jadwal</h4>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="demo-inline-spacing">
                        <div class="d-flex justify-content-end">
                            <button type="button" class="btn btn-icon btn-primary m-1" data-bs-toggle="modal"
                                data-bs-target="#basicModal">
                                <span class="tf-icons bx bx-plus"></span>
                            </button> 
                            <a href="/jadwal/print_jadwal" class="btn btn-icon btn-secondary m-1">
                                <i class="tf-icons bx bx-printer"></i>
                            </a>                                                                 
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive text-wrap">
                    <table class="table table-bordered table-striped  table-hover" >
                        <thead>
                            <tr>
                                <th class="text-center" width="50px">No</th>
                                <th class="text-center">Nama Kegiatan</th>
                                <th class="text-center">Tanggal Kegiatan</th>
                                <th class="text-center">Tanggal Berakhir</th>
                                <th class="text-center">Lokasi Kegiatan</th>
                                <th class="text-center">Waktu Mulai</th>
                                <th class="text-center">Waktu Berakhir</th>
                                <th class="text-center"width="150px">Aksi</th>
                            </tr>
                        </thead>
                        @foreach ($jadwals as $l)
                        <tbody>
                        <td>{{ ++$i }}</td>
                        <td>{{ $l->namakegiatan }}</td>
                        <td>{{ $l->tanggalkegiatan }}</td>
                        <td>{{ $l->tanggalselesai }}</td>
                        <td>
                            @foreach($lokasi as $loc)
                                @if ($l->lokasi_id == $loc->id)
                                    {{ $loc->nama }}
                                @endif
                            @endforeach
                        </td>
                        <td>{{ $l->waktu_mulai }}</td>
                        <td>{{ $l->waktu_berakhir }}</td>
                        <td>
                            <button type="button" class="btn btn-icon btn-primary m-1" data-bs-toggle="modal"
                                data-bs-target="#basicModal{{ $l->id }}">
                                <span class="tf-icons bx bx-edit"></span>
                            </button>
                            {{-- <a class="btn btn-icon btn-danger m-1" href="/jadwal/delete/{{ $l->id }}"><span
                                    class="tf-icons bx bx-trash"></span></a> --}}
                            
                            <a class="btn btn-icon btn-danger m-1" href="#" data-bs-toggle="modal" data-bs-target="#konfirmasiModal_{{ $l->id }}">
                            <span class="tf-icons bx bx-trash"></span>
                            </a>

                            <!-- Modal Konfirmasi Hapus -->
                            <div class="modal fade" id="konfirmasiModal_{{ $l->id }}" tabindex="-1" role="dialog" aria-labelledby="konfirmasiModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="konfirmasiModalLabel">Konfirmasi Hapus</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Apakah Anda yakin ingin menghapus, <b>{{ $l->namakegiatan }}</b>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                            <a class="btn btn-danger" href="/jadwal/delete/{{ $l->id }}">Hapus</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            

                            <!-- Edit Modal -->
                            <div class="modal fade" id="basicModal{{ $l->id }}" tabindex="-1"
                                aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel1">Edit Data Location</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{!! url('/jadwal/update') !!}" method="POST">
                                                {{-- @method('patch') --}}
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $l->id }}">
                                                <div class="row g-2">
                                                    <div class="col mb-0">
                                                        <label for="namakegiatan" class="form-label">Nama Kegiatan</label>
                                                        <input type="text" id="namakegiatan" name="namakegiatan"
                                                            class="form-control" placeholder="Nama Kegiatan"
                                                            value="{{ $l->namakegiatan }}" required />
                                                    </div>
                                                </div>

                                                <div class="row g-2">
                                                    <div class="col mb-0">
                                                        <label for="singkatan"
                                                            class="form-label mt-3">Tanggal Kegiatan</label>
                                                        <input type="date" id="tanggalkegiatan" name="tanggalkegiatan"
                                                            class="form-control" placeholder="Tanggal Kegiatan"
                                                            value="{{ $l->tanggalkegiatan }}" required />
                                                    </div>
                                                </div>

                                                <div class="row g-2">
                                                    <div class="col mb-0">
                                                        <label for="singkatan"
                                                            class="form-label mt-3">Tanggal Berakhir</label>
                                                        <input type="date" id="tanggalselesai" name="tanggalselesai"
                                                            class="form-control" placeholder="Tanggal Berakhir"
                                                            value="{{ $l->tanggalselesai }}" required />
                                                    </div>
                                                </div>

                                                <div class="row g-2">
                                                    <div class="col mb-0">
                                                    <label for="lokasiDropdown" class="form-label mt-3">Pilih Lokasi</label>
                                                    <select class="form-control" id="lokasiDropdown" name="lokasi_id">
                                                        <option value="">Pilih Lokasi</option>
                                                        @php
                                                        $lokasiAllowed = [30, 84, 20, 85, 43, 60, 55, 14, 86, 78, 81, 79, 76, 80, 87]; 
                                                        $lokasiSorted = $lokasi->sortBy('nama');
                                                        @endphp
                                                        @foreach($lokasiSorted as $loc)
                                                            @if(in_array($loc->id, $lokasiAllowed))
                                                            <option value="{{ $loc->id }}" {{ $l->lokasi_id == $loc->id ? 'selected' : '' }}>
                                                                {{ $loc->nama }}
                                                            </option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                    </div>
                                                </div>

                                                <div class="row g-2">
                                                    <div class="col mb-0">
                                                        <label for="singkatan"
                                                            class="form-label mt-3">Waktu Mulai</label>
                                                        <input type="date" id="waktu_mulai" name="waktu_mulai"
                                                            class="form-control" placeholder="waktu_mulai"
                                                            value="{{ $l->waktu_mulai }}" required />
                                                    </div>
                                                </div>

                                                <div class="row g-2">
                                                    <div class="col mb-0">
                                                        <label for="singkatan"
                                                            class="form-label mt-3">Waktu Berakhir</label>
                                                        <input type="date" id="waktu_berakhir" name="waktu_berakhir"
                                                            class="form-control" placeholder="waktu_berakhir"
                                                            value="{{ $l->waktu_berakhir }}" required />
                                                    </div>
                                                </div>
                                                
                                                <button type="submit" class="btn btn-primary mt-3">Update
                                                    Data</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                        </tbody>
                        @endforeach
                    </table>
                    
                    <nav aria-label="Page navigation">
                        <ul class="pagination">
                            {{ $jadwals->links() }}
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>



    <!-- Modal Add Data -->
    <div class="modal fade" id="basicModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel1">Add Data Jadwal</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{!! url('/jadwal') !!}" method="POST">
                        @csrf
                        <div class="row g-2">
                            <div class="col mb-0">
                                <label for="namakegiatan" class="form-label">Nama Kegiatan</label>
                                <input type="text" id="namakegiatan" name="namakegiatan" class="form-control"
                                    placeholder="Nama Kegiatan" required />
                            </div>
                        </div>
                        <div class="row g-2">
                            <div class="col mb-0">
                                <label for="tanggalkegiatan" class="form-label mt-3">Tanggal Kegiatan</label>
                                <input type="date" id="tanggalkegiatan" name="tanggalkegiatan" class="form-control"
                                    placeholder="Tanggal Kegiatan" required />
                            </div>
                        </div> 
                        
                        <div class="row g-2">
                            <div class="col mb-0">
                                <label for="tanggalselesai" class="form-label mt-3">Tanggal Berakhir</label>
                                <input type="date" id="tanggalselesai" name="tanggalselesai" class="form-control"
                                    placeholder="Tanggal Berakhir" required />
                            </div>
                        </div> 

                        <div class="row g-2">
                            <div class="col mb-0">
                            <label for="lokasiDropdown" class="form-label mt-3">Pilih Lokasi</label>
                            <select class="form-control" id="lokasiDropdown" name="lokasi_id">
                                <option value="">Pilih Lokasi</option>
                                @php
                                $lokasiAllowed = [30, 84, 20, 85, 43, 60, 55, 14, 86, 78, 81, 79, 76, 80, 87]; 
                                $lokasiSorted = $lokasi->sortBy('nama');
                                @endphp
                                @foreach($lokasiSorted as $loc)
                                    @if(in_array($loc->id, $lokasiAllowed))
                                        <option value="{{ $loc->id }}">{{ $loc->nama }}</option>
                                    @endif
                                @endforeach
                            </select>
                            </div>
                        </div>

                        <div class="row g-2">
                            <div class="col mb-0">
                                <label for="waktu_mulai" class="form-label mt-3">Waktu Mulai</label>
                                <input type="time" id="waktu_mulai" name="waktu_mulai" class="form-control"
                                    placeholder="Waktu Mulai" required />
                            </div>
                        </div> 

                        <div class="row g-2">
                            <div class="col mb-0">
                                <label for="waktu_berakhir" class="form-label mt-3">Waktu Berakhir</label>
                                <input type="time" id="waktu_berakhir" name="waktu_berakhir" class="form-control"
                                    placeholder="Waktu Berakhir" required />
                            </div>
                        </div> 

                        <button type="submit" class="btn btn-primary mt-3">add
                            Data</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
      
    
@endsection