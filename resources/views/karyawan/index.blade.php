
<!-- START DATA -->
@extends('layout.tampilan')

@section('konten')

<div class="my-3 p-3 bg-body rounded shadow-sm">
    <!-- FORM PENCARIAN -->
    <div class="pb-3">
        <form class="d-flex" action="{{url('home')}}" method="get">           
            <input class="form-control me-1" type="search" name="katakunci" value="{{ Request::get('katakunci') }}" placeholder="Masukkan kata kunci" aria-label="Search">
            <button class="btn btn-secondary" type="submit">Cari</button>
        </form>    
    </div>
            
    <!-- TOMBOL TAMBAH DATA -->
    <div class="pb-3">
        <a href='{{ url('home/create')}}' class="btn btn-primary">+ Tambah Data</a>
    </div>
    <table class="table table-striped">
        <thead>
            <tr>
                <th class="col-md-3">NIP</th>
                <th class="col-md-4">Nama</th>
                <th class="col-md-2">Aksi</th>  
            </tr>    
        </thead>
        <tbody>
            @foreach ($data as $item)
            <tr>
                <td>{{$item->nip}}</td>
                <td>{{$item->nama}}</td>
                <td>
                    <a href='{{url('home/'.$item->nip.'/edit')}}' class="btn btn-warning btn-sm">Edit</a>
                    <form onsubmit="return confirm('Anda yakin ingin menghapus data?')" 
                    class="d-inline" 
                    action="{{url('home/'.$item->nip)}}" method="post">
                        @csrf
                        @method('DELETE')
                       <button type="submit" name="submit" class="btn btn-danger btn-sm">Hapus</button>
                    </form>
                </td>
            </tr>  
            @endforeach  
        </tbody>
    </table> 
    {{$data->links()}}   
</div>
    
@endsection