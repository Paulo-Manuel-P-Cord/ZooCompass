@extends('layouts.app')

@section('content')
    <script type="text/javascript">
        // Redireciona automaticamente para a rota admin.menu
        window.location.href = "{{ route('admin.menu') }}";
    </script>
@endsection
