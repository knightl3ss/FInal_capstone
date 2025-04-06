<!-- Remarks Button (Outside the Filter Section) -->
<div class="d-flex justify-content-left mb-4">
    <button id="remarksButton" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#remarksModal">
        Select Remarks
    </button>
</div>

<!-- Modal for Remarks -->
<div class="modal fade" id="remarksModal" tabindex="-1" aria-labelledby="remarksModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="remarksModalLabel">Select Remarks</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Remarks Filter Section -->
                <div class="d-flex mb-4 justify-content-between">
                    <button class="btn btn-outline-primary" id="retirableFilter">Retirable</button>
                    <button class="btn btn-outline-primary" id="retiredFilter">Retired</button>
                    <button class="btn btn-outline-primary" id="nonRetirableFilter">Non-Retirable</button>
                </div>

                <!-- Table for Remarks Data -->
                <table class="table" id="remarksTable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Office</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Data Rows will be inserted dynamically here -->
                    </tbody>
                </table>

                <!-- Vacant Plantilla Item Button -->
                <button class="btn btn-info" id="vacantPlantillaBtn">Vacant Plantilla Item</button>

                <!-- Vacant Position Table -->
                <table class="table mt-4" id="vacantPositionsTable" style="display: none;">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Position</th>
                            <th>Department</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Vacant Position Data will be inserted dynamically here -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
