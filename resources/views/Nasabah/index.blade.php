@extends('Template-0')
@section('content')
<div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>DATA NASABAH</h1>
          </div> 
{!! Html::ul($errors->all()) !!}
<br>
@livewire('nasaba')
</section>
</div>
@livewireScripts
<script type="text/javascript">
  window.livewire.on('nasabahStore', () => {
    $('#updateModal').modal('hide');
    $('#detailModal').modal('hide');
    $('#createModal').modal('hide');
  });
</script>
@stop