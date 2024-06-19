<div>
    <form wire:submit.prevent="search">
        <input type="text" placeholder="Rechercher une valeur ..." wire:model="query">
        <button type="submit">Rechercher</button>
    </form>

    <table class="table">
        <thead>
            <tr>
                <th>Nom</th>
                @if(!$editedRowId)
                    <th>Motif</th>
                    <th>Date</th>
                    <th>Email</th>
                    <th>Tel</th>
                    <th>Editer</th>
                @else
                    <th>Date</th>
                    <th>Heure</th>
                    <th>Médecin</th>
                    <th>Valider</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @if(!$editedRowId)
                @foreach($demandePatient as $demande)
                @if($demande->status !== "Valider")
                    <tr wire:key="{{ $demande->id }}">
                        <td><span class="pl-2">{{ optional($demande->patient)->nom }}</span></td>
                        <td>{{ $demande->motif }}</td>
                        <td>{{ $demande->created_at }}</td>
                        <td>{{ optional($demande->patient)->email }}</td>
                        <td>{{ optional($demande->patient)->tel }}</td>
                        <td>
                            <button wire:click.prevent="editRow({{ $demande->id }})" class="badge badge-outline-info">Editer</button>
                        </td>
                    </tr>
                    @endif
                @endforeach

            @else
                <tr>
                    <td><span class="pl-2">{{ $selectedRendezVous['nom'] }}</span></td>
                    <td><input type="date" name="date" wire:model.defer="date"></td>
                    <td><input type="time" name="heure" wire:model.defer="heure"></td>
                    <td>
                        <select name="medecin_id" wire:model.defer="medecin_id">
                            @foreach($medecinAll as $medecin)
                                <option value="{{ $medecin->id }}">{{ $medecin->nom }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <button class="badge badge-outline-success" wire:click="save">Valider</button>
                    </td>
                </tr>
            @endif
        </tbody>
    </table>

    {{ $demandePatient->links() }}
</div>
