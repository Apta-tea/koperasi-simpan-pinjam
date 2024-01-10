@extends('Template-0')
@section('content')
<div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>NASABAH</h1>
          </div> 
{!! Html::ul($errors->all()) !!}
@livewire('transact', ['id'=>Request::segment(2)])
</section>
</div>
@livewireScripts
@stop