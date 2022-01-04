<x-app-layout>
    <div class="container">

        <x-slot name="header">
            <h1 class="mt-5">
                {{ __('presents.create_title') }}
            </h1>
        </x-slot>

        <div class="py-12">

            @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Whoops!</strong> There were some problems with your input.<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('presents.store') }}" method="POST" class="row g-3">
                @csrf
                <div class="col-12">
                    <label for="title" class="form-label">{{__('presents.create_form_title')}}</label>
                    <input type="text" id="title" required name="title"
                           class="form-control @error('title') is-invalid @enderror"
                           placeholder=""
                           value="{{ old('title') }}" maxlength="255"
                           @error('title')aria-describedby="validationServerTitle" @enderror>
                    @error('title')
                    <div id="validationServerTitle" class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Description:</strong>
                            <textarea class="form-control" style="height:150px" name="description" placeholder="Enter Description"></textarea>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>

            </form>
        </div>
    </div>
</x-app-layout>
