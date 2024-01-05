@extends('Template-0')
@section('content')
<div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>Profile Koperasi</h1>
          </div> 
{!! Html::ul($errors->all()) !!}
<br>
@livewire('profil')
</section>
</div>
@livewireScripts
  <script type="text/javascript">
  window.livewire.on('profilStore', () => {
    $('#createModal').modal('hide');
    $('#updateModal').modal('hide');
  });
</script>
@stop