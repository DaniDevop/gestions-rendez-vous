<div>

     <form wire:submit="search">
        <input type="text" placeholder="Rechercher une valeur ..."  wire:model="query">
        <button type="submit">Search posts</button>
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
                <tr wire:key="{{ $demande->id }}">
                    <td><span class="pl-2">{{ $demande->patient->nom }}</span></td>
                    <td>{{ $demande->motif }}</td>
                    <td>{{ $demande->date }}</td>
                    <td>{{ $demande->heure }}</td>
                    <td>{{ $demande->medecin->nom }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $patientRdvAll->links() }}
</div>
