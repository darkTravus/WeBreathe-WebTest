@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Créer un Nouveau Module</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('modules.store') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="name" class="form-label">Nom du Module</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description du Module</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description">{{ old('description') }}</textarea>
                        </div>

                        <button type="submit" class="btn btn-primary">Ajouter le Module</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Success message with fade-in/fade-out animation -->
    <div id="successMessage" class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
        @if (session('success'))
            <div class="toast align-items-center text-white bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="d-flex">
                    <div class="toast-body">
                        {{ session('success') }}
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
            </div>
        @endif
    </div>
@endsection

@section('script')
    <script>
        // Show success message with fade-in/fade-out animation
        $(document).ready(function() {
            $('.toast').toast('show');
        });
    </script>
@endsection
