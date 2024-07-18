@extends('layouts.master')

@section('content')
    <!-- notify -->
    @include('includes.notify')

    <div class="container-fluid px-4">
        <h3 class="mt-4 mb-0">Submission List</h3>
        <ol class="breadcrumb mb-3">
            <li class="breadcrumb-item active">Home / Submission List</li>
        </ol>
        <div class="row">
            <div class="col-12 mb-3">
                <marquee class="p-3 bg-white rounded border border-2 border-warning">
                    {{ @$control->site_notice }}
                </marquee>
            </div>
            <div class="col-12">
                <div class="card mb-4 border border-2 border-warning bg-white shadow">
                    <div class="card-header">
                        <i class="fas fa-table me-1"></i>
                        My Submission List
                    </div>
                    <div class="card-body">
                        <table id="datatablesSimple">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Date of Birth</th>
                                    <th>Nationality</th>
                                    <th>Gender</th>
                                    {{-- <th>Created</th> --}}
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Date of Birth</th>
                                    <th>Nationality</th>
                                    <th>Gender</th>
                                    {{-- <th>Created</th> --}}
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach ($cards as $k => $card)
                                    <tr>
                                        <td>{{ $k + 1 }}</td>
                                        <td>{{ $card->name }}</td>
                                        <td>{{ date_format(date_create($card->dob), 'd/m/Y') }}</td>
                                        <td>{{ $card->nationality }}</td>
                                        <td>{{ $card->gender }}</td>
                                        <td>
                                            <a class="btn btn-sm btn-success rounded-circle" href="{{route('card.edit', Crypt::encryptString($card->id))}}">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </a>
                                            <a class="btn btn-sm btn-danger rounded-circle dltBtn" data-action="{{route('delete.card', Crypt::encryptString($card->id))}}">
                                                <i class="fa-solid fa-trash"></i>
                                            </a>
                                            <a class="btn btn-sm btn-info rounded-circle" href="{{route('card.print.details', Crypt::encryptString($card->id))}}">
                                                <i class="fa-solid fa-download"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script>
        // delete card
        $(document).on('click', '.dltBtn', function () {
            let id = $(this).data('id');
            let action = $(this).data('action');

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    location.href = action;
                }
            })

        });
    </script>
@endpush
