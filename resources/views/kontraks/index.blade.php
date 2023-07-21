<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Data Pegawai </title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">

    <style type="text/css">
        /* Custom page CSS
        -------------------------------------------------- */
        /* Not required for template or sticky footer method. */

        main > .container {
          padding: 60px 15px 0;
        }
    </style>
</head>

<body class="d-flex flex-column h-100">

    <header>
        <!-- Fixed navbar -->
        <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">DPW</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <ul class="navbar-nav me-auto mb-2 mb-md-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">Kontrak</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Jabatan</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="">Pegawai</a>
                        </li>
                    </ul>
                    <form class="d-flex">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success" type="submit">Search</button>
                    </form>
                </div>
            </div>
        </nav>
    </header>


    <!-- Begin page content -->
    <main class="flex-shrink-0">
        <div class="container">
            <h1 class="mt-5">Laravel Ajax Example <a href="javascript:void(0)" class="btn btn-primary" style="float: right;"  data-bs-toggle="modal" data-bs-target="#add-kontraks-modal">Tambah Kontrak</a></h1>

            <table class="table" id="kontraks-table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Jabatan</th>
                        <th scope="col">Nama Pegawai</th>
                        <th scope="col">Kontrak</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($kontrak as $kontrak)
                        <tr>
                            <th scope="row">{{ $kontrak->id }}</th>
                            <td>{{ ($kontrak->jabatan_pegawai != null) ? $kontrak->jabatan_pegawai->nama_jabatan : '' }}</td>
                            <td>{{ ($kontrak->Pegawai != null) ? $kontrak->Pegawai->nama_pegawai : '' }}</td>
                            <td>{{ $kontrak->lama_kontrak }}</td>
                            <td>
                                <!-- <a href="/{{$kontrak->id}}/edit" class="btn btn-warning"> Edit</a> -->
                                <button class="btn btn-primary"  data-bs-toggle="modal" data-bs-target="#add-kontraks-modal" onclick="edit({{$kontrak}})">edit Kontrak</button>
                                <form action="/kontraks/{{ $kontrak->id }}" method="post" class="d-inline">
                                    @method('DELETE')
                                    @csrf
                                    <button class="btn btn-danger btn-sm" type="submit" onclick="return confirm('Yakin Akan Menghapus Data?')"> Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    
                </tbody>
            </table>

        </div>
    </main>

    <!-- The Modal -->
    <div class="modal" id="add-kontraks-modal">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Add Project</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form data-action="{{ route('kontraks.store') }}" method="POST" enctype="multipart/form-data" id="add-kontraks-form">
                    <!-- Modal body -->
                    <div class="modal-body">
                        <div id="msg" style="color:red"> </div>
                        @csrf
                        <div class="mb-3">
                            <label for="jabatan" class="form-label">Jabatan</label> <br>
                            <select class="form-select" require=true aria-label="Default select example" name="jabatan_pegawai_id" id="jabatan">
                                <option selected>Pilih jabatan</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="pegawai" class="form-label">Pegawai</label>
                            <select class="form-select" require aria-label="Default select example" name="pegawai_id" id="pegawai">
                                <option selected>Pilih Pegawai</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="lama_kontrak" class="form-label">Lama Kontrak</label>
                            <input type="text" require class="form-control" id="lama_kontrak" placeholder="kontrak" name="lama_kontrak">
                            <input type="hidden" class="form-control" id="id" placeholder="kontrak" name="id">
                        </div>

                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Save</button>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
    <script src="{{ asset('js/projects.js') }}" defer></script>

</body>

</html>