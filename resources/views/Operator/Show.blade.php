@extends('Template-0')
@section('content')
<div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>DATA OPERATOR</h1>
          </div>
{!! Html::ul($errors->all()) !!}
<br>
@livewire('operator')
</section>
</div>
@livewireScripts
  <script type="text/javascript">
  window.livewire.on('operatorStore', () => {
    $('#createModal').modal('hide');
  });
</script>
@stop