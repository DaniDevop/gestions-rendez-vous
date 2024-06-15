<!DOCTYPE html>
<html lang="en">
@include('templates.head')
<link href="https://unpkg.com/@fullcalendar/core@4.4.2/main.min.css" rel="stylesheet">
<link href="https://unpkg.com/@fullcalendar/daygrid@4.4.2/main.min.css" rel="stylesheet">
<script src="https://unpkg.com/@fullcalendar/core@4.4.2/main.min.js"></script>
<script src="https://unpkg.com/@fullcalendar/daygrid@4.4.2/main.min.js"></script>
<script src="https://unpkg.com/@fullcalendar/interaction@4.4.2/main.min.js"></script>
@livewireStyles

<body>
    <div class="container-scroller">
        @include('templates.sidebar')
        <div class="container-fluid page-body-wrapper">
            @include('templates.navbar')
            <div class="main-panel">
                <div class="content-wrapper">
                    <div id="calendar"></div>
                </div>
                <footer class="footer">
                    <div class="d-sm-flex justify-content-center justify-content-sm-between">
                        <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © bootstrapdash.com 2020</span>
                        <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Free <a href="https://www.bootstrapdash.com/bootstrap-admin-template/" target="_blank">Bootstrap admin templates</a> from Bootstrapdash.com</span>
                    </div>
                </footer>
            </div>
        </div>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title fs-5" id="exampleModalLabel">Ajout</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="specialiteForm" class="forms-sample" method="POST" action="{{route('add.Specialite')}}">
                        @csrf
                        <div class="form-group">
                            <label for="date">Date</label>
                            <input type="text" class="form-control" id="date" name="date" placeholder="Designation" required>
                        </div>
                        <div class="form-group">
                            <label for="medecin">Medecin</label>
                            <select name="title" id="medecin" class="form-control">
                                @foreach($medecins as $medecin)
                                <option value="{{ $medecin->nom }}">{{ $medecin->nom }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary mr-2">Submit</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </form>
                </div>
                <div class="modal-footer"></div>
            </div>
        </div>
    </div>

    <!-- Modal for updating events -->
    <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title fs-5" id="updateModalLabel">Update</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="updateForm" class="forms-sample">
                        @csrf
                        <div class="form-group">
                            <label for="updateDate">Date</label>
                            <input type="text" class="form-control" id="updateDate" name="date" placeholder="Designation" required>
                        </div>
                        <div class="form-group">
                            <label for="updateMedecin">Medecin</label>
                            <select name="title" id="updateMedecin" class="form-control">
                                @foreach($medecins as $medecin)
                                <option value="{{ $medecin->nom }}">{{ $medecin->nom }}</option>
                                @endforeach
                            </select>
                        </div>
                        <input type="hidden" id="updateEventId" name="id">
                        <button type="submit" class="btn btn-primary mr-2">Update</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </form>
                </div>
                <div class="modal-footer"></div>
            </div>
        </div>
    </div>

    @include('templates.js')
    @livewireScripts
    @stack('scripts')
</body>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            plugins: ['dayGrid', 'interaction'],
            defaultView: 'dayGridMonth',
            editable: true,
            events: '/listeEmploie',
            eventRender: function(info) {
                var btnEdit = document.createElement('button');
                btnEdit.innerHTML = 'Edit';
                btnEdit.className = 'btn btn-primary btn-sm';
                btnEdit.onclick = function() {
                    document.getElementById('updateDate').value = info.event.start.toISOString().split('T')[0];
                    document.getElementById('updateMedecin').value = info.event.title;

                    document.getElementById('updateEventId').value = info.event.id;
                    $('#updateModal').modal('show');
                };

                var btnDelete = document.createElement('button');
                btnDelete.innerHTML = 'Delete';
                btnDelete.className = 'btn btn-danger btn-sm';
                btnDelete.onclick = function() {
                    if (confirm('Are you sure you want to delete this event?')) {
                        fetch('/deleteEmploie', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify({ id: info.event.id })
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.status === 'success') {
                                info.event.remove();
                            } else {
                                alert('Something went wrong!');
                            }
                        });
                    }
                };

                var actionDiv = document.createElement('div');
                actionDiv.appendChild(btnEdit);
                actionDiv.appendChild(btnDelete);

                var titleDiv = info.el.querySelector('.fc-title');
                titleDiv.appendChild(document.createElement('br'));
                titleDiv.appendChild(actionDiv);
            },
            dateClick: function(info) {
                $('#exampleModal').modal('show');
                document.getElementById('date').value = info.dateStr;
            }
        });
        calendar.render();

        // Handle form submission for adding new events
        document.getElementById('specialiteForm').addEventListener('submit', function(event) {
            event.preventDefault();

            var date = document.getElementById('date').value;
            var title = document.getElementById('medecin').value;
            var formData = new FormData(this);

            fetch('/addEmploie', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    calendar.addEvent({
                        title: title,
                        start: date
                    });
                    $('#exampleModal').modal('hide');
                } else {
                    alert('Something went wrong!');
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        });

        // Handle form submission for updating events
        document.getElementById('updateForm').addEventListener('submit', function(event) {
            event.preventDefault();

            var id = document.getElementById('updateEventId').value;
            var date = document.getElementById('updateDate').value;
            var title = document.getElementById('updateMedecin').value;
            console.log("ID :"+id);

            fetch('/updateEmploie', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ id: id, date: date, title: title })
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    var event = calendar.getEventById(id);
                    event.setStart(date);
                    event.setProp('title', title);
                    $('#updateModal').modal('hide');
                } else {
                    alert('Something went wrong!');
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        });
    });
</script>
</html>
