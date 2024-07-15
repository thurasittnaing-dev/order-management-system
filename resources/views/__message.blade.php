<div class="clear-both"></div>

@if (!empty(session('success')))
    <div id="success-alert" class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
    </div>
@endif

@if (!empty(session('error')))
    <div id="error-alert" class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
    </div>
@endif

@if (session('import-error'))
    <div id="import-error" class="alert alert-danger alert-dismissible fade show" role="alert">
        @foreach (session('import-error') as $error)
            {{ $error }}<br>
        @endforeach
    </div>
@endif

{{-- @if (session('import-error'))
    <div id="import-error" class="alert alert-danger alert-dismissible fade show" role="alert">
        @foreach (session('import-error') as $error)
            {{ $error }}<br>
        @endforeach
    </div>
@endif --}}

{{-- @if (session('import-error'))
    <div id="import-error" class="alert alert-danger alert-dismissible fade show" role="alert">
        @foreach (session('import-error') as $error)
            {{ $error }}<br>
        @endforeach
    </div>
@endif --}}


@if (!empty(session('warning')))
    <div id="warning-alert" class="alert alert-warning alert-dismissible fade show" role="alert">
        {{ session('warning') }}
    </div>
@endif

@if (!empty(session('info')))
    <div id="info-alert" class="alert alert-info alert-dismissible fade show" role="alert">
        {{ session('info') }}
    </div>
@endif

@if (!empty(session('secondary')))
    <div id="secondary-alert" class="alert alert-secondary alert-dismissible fade show" role="alert">
        {{ session('secondary') }}
    </div>
@endif

@if (!empty(session('primary')))
    <div id="primary-alert" class="alert alert-primary alert-dismissible fade show" role="alert">
        {{ session('primary') }}
    </div>
@endif

@if (!empty(session('light')))
    <div id="light-alert" class="alert alert-light alert-dismissible fade show" role="alert">
        {{ session('light') }}
    </div>
@endif

<script>
    // Function to close alerts after 5 seconds
    function closeAlert(alertId) {
        const alertElement = document.getElementById(alertId);
        if (alertElement) {
            setTimeout(() => {
                alertElement.classList.remove('show');
                alertElement.classList.add('fade');
                setTimeout(() => {
                    alertElement.remove();
                }, 1000); // Fade out duration
            }, 5000); // 5000 milliseconds = 5 seconds
        }
    }

    // Call the function for each alert
    closeAlert('success-alert');
    closeAlert('error-alert');
    closeAlert('warning-alert');
    closeAlert('info-alert');
    closeAlert('secondary-alert');
    closeAlert('primary-alert');
    closeAlert('light-alert');
    closeAlert('import-error')
</script>
