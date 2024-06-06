<!-- HTML Form -->
<form id="studentForm" action="{{ route('users.store') }}" method="POST">
    @csrf
    <select name="school" id="school">
        <option value="">Select your school</option>
      @foreach ($schools as $school)
        <option value="{{ $school->id}}">{{ $school->id}}:{{ $school->name}}</option> 
      @endforeach
    </select>
    <select name="department" id="department">
        
    </select>
    <select name="course" id="course">
        <!-- Options populated dynamically using JavaScript -->
        
    </select>
    <button type="submit">Submit</button>
</form>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var schoolSelect = document.getElementById('school');
        var departmentSelect = document.getElementById('department');
        var courseSelect = document.getElementById('course');

        schoolSelect.addEventListener('change', function() {
            var school_id = this.value;
            if (school_id) {
                fetch('/departments/' + school_id)
                    .then(response => response.json())
                    .then(data => {
                        departmentSelect.innerHTML = '<option value="">Select Department</option>';
                        data.forEach(function(department) {
                            var option = document.createElement('option');
                            option.value = department.id;
                            option.text = department.name;
                            departmentSelect.appendChild(option);
                        });
                    })
                    .catch(error => console.error('Error:', error));
            } else {
                departmentSelect.innerHTML = '<option value="">Select Department</option>';
                courseSelect.innerHTML = '<option value="">Select Course</option>';
            }
        });

        // The code for populating courses can be added similarly
    });
</script>

