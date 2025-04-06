<link rel="stylesheet" href="{{ asset('css/nosa.css') }}">

<!-- NOSA Modal -->
<div class="modal fade" id="nosaModal" tabindex="-1" aria-labelledby="nosaModalLabel">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="nosaModalLabel">Generate NOSA</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('nosa.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="personnel_id" id="personnel_id">
                    <div class="card mb-4">
                        <div class="card-body">
                            
                            <!-- Office Selection -->
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label">Current Date</label>
                                    <input type="date" class="form-control" id="current_date" name="current_date" readonly>
                                </div>
                            </div>

                            <!-- Personnel Details -->
                            <div class="row">

                                <div class="col-md-3">
                                    <label class="form-label">Salutation</label>
                                    <select class="form-control" name="salutation">
                                        <option value="Mr.">Mr.</option>
                                        <option value="Ms.">Ms.</option>
                                        <option value="Mrs.">Mrs.</option>
                                        <option value="Dr.">Dr.</option>
                                    </select>
                                </div>

                                <div class="col-md-3">
                                    <label class="form-label">Name</label>
                                    <input type="text" class="form-control" id="personnel_name" readonly>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">Position Title</label>
                        <input type="text" class="form-control" id="personnel_position" readonly>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">Office</label>
                        <input type="text" class="form-control" id="personnel_office" readonly>
                                </div>
                            </div>

                            <div class="row mt-2">
                                <div class="row mt-2">
                                    <h6 class="col-6 text-center">Adjusted Monthly Basic Salary</h6>
                                    <h6 class="col-6 text-center">Actual Monthly Basic Salary</h6>
                                    {{-- Adjusted Monthly Basic Salary --}}
                                    <div class="col-md-3">
                                        <label class="form-label">Effective Date</label>
                                        <input type="date" class="form-control" name="adjusted_salary_effective_date">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">Amount in Peso</label>
                                        <input type="text" class="form-control" name="adjusted_salary_amount" oninput="formatCurrency(this)">
                                    </div>
                                    {{-- Actual Monthly Basic Salary --}}
                                    <div class="col-md-3">
                                        <label class="form-label">As of Date</label>
                                        <input type="date" class="form-control" name="actual_salary_as_of_date">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">Amount in Peso</label>
                                        <input type="text" class="form-control" name="actual_salary_amount" oninput="formatCurrency(this)">
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <label class="form-label">Salary Grade (SG)</label>
                            <input type="number" class="form-control"  name="personnel_salaryGrade" id="personnel_salaryGrade">
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">Step</label>
                                    <input type="text" class="form-control" id="personnel_step" name="personnel_step">
                                </div>
                            </div>

                            <div class="row mt-2">
                                <h6>Monthly Salary Adjustment</h6>
                                <div class="col-md-3">
                                    <label class="form-label">Effective Date</label>
                                    <input type="date" class="form-control" name="salary_adjustment_effective_date">
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">Amount in Peso</label>
                                    <input type="text" class="form-control" name="salary_adjustment_amount" id="salary_adjustment_amount" oninput="formatCurrency(this)">
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label"></label>
                                    <input type="text" class="form-control" name="salary_adjustment_item_no" placeholder="(1-2)">
                                </div>
                            </div>
                    <div class="d-flex justify-content-end mt-3">
                        <button type="button" class="btn btn-success" onclick="printNOSA()">Print NOSA</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>

    

        <!-- JavaScript to handle modal data -->
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                document.querySelectorAll(".generate-nosa-btn").forEach(button => {
                    button.addEventListener("click", function() {
                        document.getElementById("personnel_id").value = this.getAttribute("data-id");
                        document.getElementById("personnel_name").value = this.getAttribute("data-name");
                        document.getElementById("personnel_position").value = this.getAttribute("data-position");
                        document.getElementById("personnel_office").value = this.getAttribute("data-office");
                        document.getElementById("personnel_salaryGrade").value = this.getAttribute("data-salaryGrade");
                        document.getElementById("personnel_step").value = this.getAttribute("data-step");
                    });
                });
            });

            document.addEventListener("DOMContentLoaded", function() {
            document.querySelectorAll(".generate-nosa-btn").forEach(button => {
                button.addEventListener("click", function() {
                    document.getElementById("personnel_id").value = this.getAttribute("data-id");
                    document.getElementById("current_date").value = new Date().toISOString().split('T')[0]; // Auto-fill current date

                });

            });
            
        });

        // number format
        function formatCurrency(input) {
    // Remove non-numeric characters except dot
    let value = input.value.replace(/[^0-9.]/g, '');
    
    // Split the number into integer and decimal parts
    let parts = value.split('.');
    let integerPart = parts[0] ? parseInt(parts[0], 10).toLocaleString() : '';
    let decimalPart = parts[1] ? parts[1].slice(0, 2) : '';

    // Ensure two decimal places if decimal exists
    input.value = decimalPart ? `${integerPart}.${decimalPart}` : integerPart;
}

        </script>

        {{-- print --}}
    <script src="{{ asset('js/plantilla/nosa/letter.js') }}"></script>