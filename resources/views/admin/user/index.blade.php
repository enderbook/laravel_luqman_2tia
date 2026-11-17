    @extends('layouts.admin.app')
    @section('content')
        {{-- start main content --}}
        <div class="py-4">
            <nav aria-label="breadcrumb" class="d-none d-md-inline-block">
                <ol class="breadcrumb breadcrumb-dark breadcrumb-transparent">
                    <li class="breadcrumb-item">
                        <a href="#">
                            <svg class="icon icon-xxs" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                                </path>
                            </svg>
                        </a>
                    </li>
                    <li class="breadcrumb-item"><a href="#">user</a></li>
                </ol>
            </nav>
            <div class="d-flex justify-content-between w-100 flex-wrap">
                <div class="mb-3 mb-lg-0">
                    <h1 class="h4">Data user</h1>
                    <p class="mb-0">List data seluruh user</p>
                </div>
                <div>
                    <a href="{{ route('user.create') }}" class="btn btn-success text-white"><i
                            class="far fa-question-circle me-1"></i> Tambah user</a>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12 mb-4">
                <div class="card border-0 shadow mb-4">
                    <div class="card-body">
                        <div class="table-responsive">
                            <form method="GET" action="{{ route('user.index') }}" class="mb-3">
                                <div class="row">


                                    <div class="col-md-3">
                                        <div class="input-group">
                                            <input type="text" name="search" class="form-control" id="exampleInputIconRight" value="{{request('search')}}" placeholder="Search" aria-label="Search">
                                            <button type="submit" class="input-group-text" id="basic-addon2">
                                            <svg class="icon icon-xxs" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path></svg>
                                            </button>
                                            @if(request('search'))
                                                    <a href="{{ request()->fullUrlWithQuery(['search'=> null]) }}" class="btn btn-outline-secondary ml-3" id="clear-search"> Clear</a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <table id="table-user" class="table table-centered table-nowrap mb-0 rounded">
                                <thead class="thead-light">
                                    <tr>
                                        <th class="border-0">Name</th>
                                        <th class="border-0">Email</th>
                                        <th class="border-0 rounded-end">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($dataUser as $item)
                                        <tr>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->email }}</td>
                                            <td><a href="{{ route('user.edit', $item->id) }}"
                                                    class="btn btn-info btn-sm">
                                                    <svg class="icon icon-xs me-2" data-slot="icon" fill="none"
                                                        stroke="currentColor" viewBox="0 0 24 24"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z">
                                                        </path>
                                                    </svg>
                                                    Edit
                                                </a>
                                                <form action="{{ route('user.destroy', $item->id) }}" method="POST"
                                                    style="display: inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"
                                                        onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                                        <svg class="icon icon-xs me-2" data-slot="icon" fill="none"
                                                            stroke="currentColor" viewBox="0 0 24 24"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                            </path>
                                                        </svg>
                                                        Delete
                                                    </button>
                                                </form>
                                            </td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="mt-3">
                                {{ $dataUser->links('pagination::bootstrap-5') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- end main content --}}
    @endsection
