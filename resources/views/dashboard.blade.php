<x-app-layout>
    @section('title')
        Dashboard
    @endsection

    @push('css')
        {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/apexcharts@3.35.3/dist/apexcharts.min.css"> --}}
    @endpush

    <div class="row">
        <div class="col-12 d-flex align-items-stretch mb-4">
            <div class="card w-100 bg-primary-subtle overflow-hidden shadow-none">
                <div class="card-body position-relative">
                    <div class="row">
                        <div class="col-sm-7">
                            <div class="d-flex align-items-center mb-7">
                                <div class="rounded-circle overflow-hidden me-6">
                                    @if (Auth::user()->avatar)
                                        <img src="{{ asset('storage/uploads/user_avatars/' . Auth::user()->avatar) }}" alt="modernize-img" width="40" height="40">
                                    @else
                                        <img src="{{ asset('assets/images/profile/user-1.jpg') }}" alt="modernize-img" width="40" height="40">
                                    @endif
                                </div>
                                <h5 class="fw-semibold mb-0 fs-5">Welcome, {{ Auth::user()->name }}!</h5>
                            </div>
                            <div class="d-flex align-items-center">
                                <div class="border-end pe-4 border-muted border-opacity-10">
                                    <h3 class="mb-1 fw-semibold fs-8 d-flex align-content-center">5<i class="ti ti-arrow-up-right fs-5 lh-base text-success"></i></h3>
                                    <p class="mb-0 text-dark">Today's Requisition Slip</p>
                                </div>
                                <div class="ps-4">
                                    <h3 class="mb-1 fw-semibold fs-8 d-flex align-content-center">40<i class="ti ti-arrow-up-right fs-5 lh-base text-success"></i></h3>
                                    <p class="mb-0 text-dark">Total Requisition Slip</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-5">
                            <div class="welcome-bg-img mb-n7 text-end">
                                <img src="{{ asset('assets/images/backgrounds/welcome-bg.svg') }}" alt="modernize-img" class="img-fluid">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6 d-flex align-items-stretch">
            <div class="card w-100">
                <div class="card-body">
                    <h4 class="card-title fw-semibold">Requisition Slip Updates</h4>
                    <p class="card-subtitle mb-4">Overview of Requests</p>
                    <div class="d-flex align-items-center">
                        <div class="me-4">
                            <span class="round-8 text-bg-primary rounded-circle me-2 d-inline-block"></span>
                            <span class="fs-2">Created</span>
                        </div>
                        <div>
                            <span class="round-8 text-bg-secondary rounded-circle me-2 d-inline-block"></span>
                            <span class="fs-2">Approved</span>
                        </div>
                    </div>
                    <div id="revenue-chart" class="revenue-chart mx-n3"></div>
                </div>
            </div>
        </div>

        <div class="col-lg-6 d-flex align-items-stretch">
            <a href="{{ route('rs.report') }}" class="text-decoration-none text-dark w-100"> 
                <div class="card w-100 hover-shadow">
                    <div class="card-body">
                        <div class="row align-items-start">
                            <div class="col-8">
                                <h4 class="card-title mb-9 fw-semibold">Report Requisitions</h4>
                                <div class="d-flex align-items-center mb-3">
                                    <h4 class="fw-semibold mb-0 me-8">Monthly RS Overview</h4>
                                    <div class="d-flex align-items-center">
                                        <span class="me-2 rounded-circle bg-success-subtle text-success round-20 d-flex align-items-center justify-content-center">
                                            <i class="ti ti-arrow-up-left">40%</i>
                                        </span>
                                        <p class="text-dark me-1 fs-3 mb-0"></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="d-flex justify-content-end">
                                    <div class="p-2 bg-primary-subtle rounded-2 d-inline-block">
                                        <img src="{{ asset('assets/images/svgs/icon-master-card-2.svg') }}" alt="modernize-img" class="img-fluid" width="24" height="24">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="monthly-earning"></div>
                    </div>
                </div>
            </a>
        </div>


        {{-- --- Leaderboard Card --- --}}
        <div class="col-lg-4 d-flex align-items-stretch">
            <div class="card w-100">
                <div class="card-body">
                    <h4 class="card-title fw-semibold">Top Requester</h4>

                    {{-- Filters --}}
                    <div class="d-flex gap-2 flex-wrap align-items-center mb-3">
                        <select class="form-select form-select-sm w-auto" id="leaderboardFilter">
                            <option value="weekly" selected>Weekly</option>
                            <option value="monthly">Monthly</option>
                        </select>

                        <select class="form-select form-select-sm w-auto" id="leaderboardYear">
                            @for ($y = date('Y'); $y >= 2024; $y--)
                                <option value="{{ $y }}" {{ $y == date('Y') ? 'selected' : '' }}>{{ $y }}</option>
                            @endfor
                        </select>
                    </div>

                    {{-- Leaderboard Content --}}
                    <div class="position-relative" style="max-height: 400px; overflow-y: auto;">
                        <div id="leaderboard-list" class="vstack gap-2">
                            <div class="text-muted text-center py-3">Loading...</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- --- Requisition Slip Overview Card --- --}}


      <div class="col-lg-8 d-flex align-items-stretch">
    <div class="card w-100">
        <div class="card-body">
            <h4 class="card-title fw-semibold">Requisition Slip Overview</h4>
            <p class="card-subtitle mb-2">Monthly Requests</p>

            <div class="d-flex align-items-center justify-content-between mb-4">
                {{-- Left side: Created & Approved indicators --}}
                <div class="d-flex align-items-center">
                    <a href="#" id="Created-requests-link" class="d-flex align-items-center text-decoration-none me-4" onclick="handleCreatedClick()">
                        <div class="bg-primary-subtle text-primary rounded-2 me-2 p-2 d-flex align-items-center justify-content-center">
                            <i class="ti ti-grid-dots fs-6"></i>
                        </div>
                        <div>
                            <h6 class="fw-semibold text-dark fs-4 mb-0" id="Created-requests-count">20</h6> {{-- Example count --}}
                            <p class="fs-3 mb-0 fw-normal">Created</p>
                        </div>
                    </a>
                    <a href="#" id="approved-requests-link" class="d-flex align-items-center text-decoration-none me-4" onclick="handleApprovedClick()"> {{-- Added me-4 for spacing --}}
                        <div class="bg-success-subtle text-success rounded-2 me-2 p-2 d-flex align-items-center justify-content-center">
                            <i class="ti ti-check fs-6"></i>
                        </div>
                        <div>
                            <h6 class="fw-semibold text-dark fs-4 mb-0" id="approved-requests-count">35</h6> {{-- Example count --}}
                            <p class="fs-3 mb-0 fw-normal">Approved</p>
                        </div>
                    </a>
                    {{-- New: Rejected indicator --}}
                    <a href="#" id="rejected-requests-link" class="d-flex align-items-center text-decoration-none" onclick="handleRejectedClick()">
                        <div class="bg-danger-subtle text-danger rounded-2 me-2 p-2 d-flex align-items-center justify-content-center">
                            <i class="ti ti-ban fs-6"></i> {{-- Example icon, you can choose another --}}
                        </div>
                        <div>
                            <h6 class="fw-semibold text-dark fs-4 mb-0" id="rejected-requests-count">10</h6> {{-- Example count --}}
                            <p class="fs-3 mb-0 fw-normal">Rejected</p>
                        </div>
                    </a>
                </div>

                {{-- Right side: Month and Year filters --}}
                <div class="d-flex">
                    <div class="me-3">
                        <label for="monthFilter" class="form-label visually-hidden">Select Month</label>
                        <select class="form-select form-select-sm w-auto" id="monthFilter">
                            <option value="01" class="fw-bold">January</option>
                            <option value="02" class="fw-bold">February</option>
                            <option value="03" class="fw-bold">March</option>
                            <option value="04" class="fw-bold">April</option>
                            <option value="05" class="fw-bold">May</option>
                            <option value="06" class="fw-bold" >June</option>
                            <option value="07" class="fw-bold">July</option>
                            <option value="08" class="fw-bold">August</option>
                            <option value="09" class="fw-bold">September</option>
                            <option value="10" class="fw-bold">October</option>
                            <option value="11" class="fw-bold">November</option>
                            <option value="12" class="fw-bold">December</option>
                        </select>
                    </div>
                    <div>
                        <label for="yearFilter" class="form-label visually-hidden">Select Year</label>
                        <select class="form-select form-select-sm w-auto" id="yearFilter">
                        </select>
                    </div>
                </div>
            </div>

            <div id="requisition-overview-chart" style="width: 100%; height: 300px;"></div>
        </div>
    </div>
</div>

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/echarts@5.3.0/dist/echarts.min.js"></script>

    <script>
        // Handle clicks for Created
        function handleCreatedClick() {
            alert('Created requests clicked!');
            // You can add logic here to redirect, filter data, etc.
            // window.location.href = '/requisitions/Created';
        }

        // Handle clicks for Approved
        function handleApprovedClick() {
            alert('Approved requests clicked!');
            // You can add logic here to redirect, filter data, etc.
            // window.location.href = '/requisitions/approved';
        }

        // New: Handle clicks for Rejected
        function handleRejectedClick() {
            alert('Rejected requests clicked!');
            // You can add logic here to redirect, filter data, etc.
            // window.location.href = '/requisitions/rejected';
        }

        // ECharts for Requisition Slip Overview
        document.addEventListener('DOMContentLoaded', function() {
            var chartDom = document.getElementById('requisition-overview-chart');
            var myChart = echarts.init(chartDom);
            var option;

            // Function to generate dummy data for the chart based on month and year
            function getChartData(month, year) {
                const baseCreated = 100 + (month * 5) + (year - 2025) * 10;
                const baseApproved = 200 + (month * 10) + (year - 2025) * 15;
                const baseRejected = 30 + (month * 2) + (year - 2025) * 5; // New: Base for Rejected

                return {
                    Created: Array.from({length: 12}, (_, i) => Math.floor(baseCreated + Math.random() * 50 - 25)),
                    approved: Array.from({length: 12}, (_, i) => Math.floor(baseApproved + Math.random() * 70 - 35)),
                    rejected: Array.from({length: 12}, (_, i) => Math.floor(baseRejected + Math.random() * 20 - 10)) // New: Rejected data
                };
            }

            // Initialize month and year filters for Requisition Overview
            const monthFilter = document.getElementById('monthFilter');
            const yearFilter = document.getElementById('yearFilter');
            const currentYear = new Date().getFullYear();
            const currentMonth = (new Date().getMonth() + 1).toString().padStart(2, '0');

            // Populate year filter
            for (let i = currentYear - 5; i <= currentYear + 5; i++) {
                const option = document.createElement('option');
                option.value = i;
                option.textContent = i;
                if (i === currentYear) {
                    option.selected = true;
                }
                yearFilter.appendChild(option);
            }

            // Set current month as selected in the filter
            monthFilter.value = currentMonth;

            // Function to get chart data from the server
            function getChartData(year, callback) {
                $.ajax({
                    url: "{{ route('rs.chart.data') }}", 
                    method: 'GET',
                    data: { year: year },
                    success: function(response) {
                        callback(response);
                    },
                    error: function(xhr, status, error) {
                        console.error('Failed to fetch chart data:', error);
                    }
                });
            }

            // Function to update the Requisition Overview chart
            function updateChart() {
            const selectedMonth = parseInt(monthFilter.value);
            const selectedYear = parseInt(yearFilter.value);

            getChartData(selectedYear, function(data) {
                option = {
                    tooltip: {
                        trigger: 'axis',
                        axisPointer: { type: 'shadow' }
                    },
                    legend: {
                        data: ['Created', 'Approved', 'Rejected'],
                        show: true,
                        top: 'bottom'
                    },
                    grid: {
                        left: '3%',
                        right: '4%',
                        bottom: '10%',
                        containLabel: true
                    },
                    xAxis: {
                        type: 'category',
                        data: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
                            'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
                    },
                    yAxis: { type: 'value' },
                    series: [
                        {
                            name: 'Created',
                            type: 'bar',
                            stack: 'total',
                            emphasis: { focus: 'series' },
                            data: data.Created,
                            itemStyle: { color: '#5D87FF' }
                        },
                        {
                            name: 'Approved',
                            type: 'bar',
                            stack: 'total',
                            emphasis: { focus: 'series' },
                            data: data.approved,
                            itemStyle: { color: '#28a745' }
                        },
                        {
                            name: 'Rejected',
                            type: 'bar',
                            stack: 'total',
                            emphasis: { focus: 'series' },
                            data: data.rejected,
                            itemStyle: { color: '#dc3545' }
                        }
                    ]
                };

                myChart.setOption(option);

                const idx = selectedMonth - 1;
                document.getElementById('Created-requests-count').innerText = data.Created[idx];
                document.getElementById('approved-requests-count').innerText = data.approved[idx];
                document.getElementById('rejected-requests-count').innerText = data.rejected[idx];
            });
        }


            // Add event listeners to filters
            monthFilter.addEventListener('change', updateChart);
            yearFilter.addEventListener('change', updateChart);

            // Initial chart render
            updateChart();

            // Optional: Resize chart with window
            window.addEventListener('resize', function () {
                myChart.resize();
            });

            // --- Leaderboard Logic (Unchanged from your original code) ---
            const leaderboardList = document.getElementById('leaderboard-list');
            const leaderboardFilter = document.getElementById('leaderboardFilter');
            const yearSelect = document.getElementById('leaderboardYear');  // Tambahkan select tahun di HTML

            function fetchLeaderboardData() {
                const selectedFilter = leaderboardFilter.value;
                const selectedYear = yearSelect.value;
                

                fetch(`/leaderboard/filter?year=${selectedYear}&filter=${selectedFilter}`)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(data => {
                        renderLeaderboard(data);
                    })
                    .catch(error => {
                        console.error('Error fetching leaderboard data:', error);
                    });
            }

            function renderLeaderboard(data) {
                leaderboardList.innerHTML = ''; // Clear previous entries
                data.sort((a, b) => b.requisitions - a.requisitions);

                for (let i = 0; i < Math.min(10, data.length); i++) {
                    const person = data[i];
                    const listItem = document.createElement('div');
                    listItem.classList.add('d-flex', 'align-items-center', 'justify-content-between', 'mb-3');

                    listItem.innerHTML = `
                        <div class="d-flex align-items-center">
                            <div class="p-2 bg-light rounded-circle me-3 d-flex align-items-center justify-content-center" style="width: 36px; height: 36px;">
                                <span class="fw-bold">${i + 1}</span>
                            </div>
                            <div>
                                <h6 class="mb-0 fs-4 fw-semibold">${person.name}</h6>
                                <p class="fs-2 text-muted mb-0">${person.department}</p>
                            </div>
                        </div>
                        <div class="badge bg-primary-subtle text-primary">
                            <p class="fs-3 fw-semibold mb-0">${person.requisitions}</p>
                        </div>
                    `;
                    leaderboardList.appendChild(listItem);
                }
            }

            // Event listeners for all filters
            leaderboardFilter.addEventListener('change', fetchLeaderboardData);
            yearSelect.addEventListener('change', fetchLeaderboardData);
            

            // Initial render
            fetchLeaderboardData();
        });
    </script>
@endpush

</x-app-layout>