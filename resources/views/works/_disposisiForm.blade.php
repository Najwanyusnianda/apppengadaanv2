

<div class="col">
    <div class="row">
        <h5><strong class="badge badge-primary">Disposisi</strong></h5>
    </div>
    <div class="row">
        <h6 class="text-center">
            <strong> {{$permintaan->judul}}</strong>
        </h6>
    </div>
</div>
<hr>
<form id="buatDisposisiForm">
<input type="hidden" name="permintaanId" value="{{$permintaan->id}}">


@if (auth()->user()->roleActiveId==1)
<select name="kasi" id="" class="form-control">
@foreach ($kasie as $person)
<option value="{{$person->userId}}">{{$person->name}}</option>
@endforeach
</select>

@elseif(auth()->user()->roleActiveId==2)
<select name="staff" id="" class="form-control">
    @foreach ($staff as $person)
    <option value="{{$person->userId}}">{{$person->name}}</option>
    @endforeach
</select>
@endif

<br>
<div class="form-group">
    
    <textarea class="form-control" id="isiDisposisi" name="isiDisposisi" rows="3" placeholder="Isi Disposisi"></textarea>
</div>

</form>