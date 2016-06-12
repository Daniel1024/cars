@extends('layout')

@section('content')
    <h1>Features</h1>
    {!! Form::open(['method'=>'POST', 'class' => 'form']) !!}
        {!! Field::selectMultiple('features[]', $features, $car->feature_ids, ['label'=>'Features', 'id'=>'features']) !!}
        <button type="submit" class="btn btn-primary">Save</button>

    {!! Form::close() !!}
@endsection

@section('scripts')
    <script>
        $(document).ready(function () {
            $('#features').select2({
                tags: true,
                tokenSeparators: [',']
            });
        });
    </script>
@endsection