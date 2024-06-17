<div>
    <section id="tmpl-structure">
        <table class="table">
            <thead>
              <tr>
                <th scope="col">Numéro</th>
                <th scope="col">Motif</th>
                <th scope="col">Medecin</th>
                <th scope="col">Status</th>
                <th scope="col">modifier</th>
              </tr>
            </thead>
            <tbody>
            @foreach( $patientRdvAll as $patientRdv)
              <tr  wire:key="{{$patientRdv->id }}">
                <th scope="row" id="motifId">  {{$patientRdv->id}} </th>
                <td id="motifCapte"> {{$patientRdv->motif}}</td>
                <td> {{optional($patientRdv->medecin)->nom}}</td>
                <td> {{$patientRdv->status}}</td>
                <td> <a href="#" class="btn btn-info" id="eventMotif" wire:click="editMotif({{$patientRdv->id}})" ><i class="bi bi-pencil-square" ></i></a> </td>
              </tr>
              @endforeach

            </tbody>
          </table>

          @if($editLine ==true)
          <form >
            @csrf
            <div class="mb-3">
              <label for="exampleInputEmail1" class="form-label">Motif</label>
              <input type="text" name="motif" class="form-control" value="{{$motifRaw['motif']}}"  wire:model.defer="motifRaw.motif"  id="motif" aria-describedby="emailHelp">
            </div>

            <input type="hidden"  name="id" value="{{$motifRaw['id']}}"     class="form-control" id="motifIdInput">

            <button  class="btn btn-primary" wire:click.prevent="save">Modifier</button>
          </form>
          @endif

    </section>
</div>
