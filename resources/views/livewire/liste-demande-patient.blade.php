<div>
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
                    <tr wire:key="{{ $demande->id }}">
                        <td><span class="pl-2">{{ $demande->patient->nom }}</span></td>
                        <td>{{ $demande->motif }}</td>
                        <td>{{ $demande->created_at }}</td>
                        <td>{{ $demande->patient->email }}</td>
                        <td>{{ $demande->patient->tel }}</td>
                        <td>
                            <button wire:click.prevent="editRow({{ $demande->id }})" class="badge badge-outline-info">Editer</button>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td><span class="pl-2">{{ $selectedRendezVous['nom'] }}</span></td>
                    <td><input type="date" name="date" wire:model="date"></td>
                    <td><input type="time" name="heure" wire:model="heure"></td>
                    <td>
                        <select name="medecin_id" wire:model="medecin_id">
                            @foreach($medecinAll as $medecin)
                                <option value="{{ $medecin->id }}">{{ $medecin->nom }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <button class="badge badge-outline-success" wire:click.prevent="save">Valider</button>
                    </td>
                </tr>
            @endif
        </tbody>
    </table>

</div>
