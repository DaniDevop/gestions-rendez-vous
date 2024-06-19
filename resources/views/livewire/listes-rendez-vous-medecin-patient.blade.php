<div>

     <form wire:submit="search">
        <input type="text" placeholder="Rechercher une valeur ..."  wire:model="query">
        <button type="submit">Recherche rendez-vous</button>
     </form>
    <table class="table">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Motif</th>
                <th>Date</th>
                <th>Heure</th>
                <th>Medecin</th>
            </tr>
        </thead>
        <tbody>
            @foreach($patientRdvAll as $demande)
            @if($demande->status == "Valider")
                <tr wire:key="{{ $demande->id }}">
                    <td><span class="pl-2">{{ optional($demande->patient)->nom }}</span></td>
                    <td>{{ $demande->motif }}</td>
                    <td>{{ $demande->date }}</td>
                    <td>{{ $demande->heure }}</td>
                    <td>{{ optional($demande->medecin)->nom }}</td>
                </tr>
                @endif
            @endforeach
        </tbody>
    </table>
    {{ $patientRdvAll->links() }}
</div>
