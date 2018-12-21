@if($config['bootstrap3-wysihtml5'] == true)
@push('js-scripts')
<script src="{{url('adminlte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')}}"></script>
@endpush
@push('css-scripts')
  <link rel="stylesheet" href="{{url('adminlte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css')}}">
@endpush
@endif


@if($config['ckeditor'] == true)
@push('js-scripts')
<script src="{{url('bower_components/ckeditor/ckeditor.js')}}"></script>
@endpush
@push('css-scripts')

@endpush
@endif



