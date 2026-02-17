<style>
    /* Dashboard Stat Cards */
    .dashboard-stat-card {
        display: flex;
        align-items: center;
        gap: 16px;
        padding: 18px;
        border-radius: 16px;
        background: rgba(255, 255, 255, 0.85);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.06);
        transition: all 0.3s ease;
        text-decoration: none;
        color: inherit;
        height: 100%;
    }

    .dashboard-stat-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 16px 40px rgba(0, 0, 0, 0.1);
    }

    /* Icon */
    .dashboard-stat-card .stat-icon {
        width: 56px;
        height: 56px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 22px;
        color: #fff;
    }

    /* Text */
    .stat-label {
        margin: 0;
        font-size: 14px;
        color: #6c757d;
    }

    .stat-value {
        margin: 0;
        font-size: 28px;
        font-weight: 700;
    }

    /* Color Variants */
    .stat-total .stat-icon {
        background: linear-gradient(135deg, #6f42c1, #8e63f4);
    }

    .stat-success .stat-icon {
        background: linear-gradient(135deg, #198754, #28c76f);
    }

    .stat-danger .stat-icon {
        background: linear-gradient(135deg, #dc3545, #ff6b6b);
    }

    .stat-warning .stat-icon {
        background: linear-gradient(135deg, #fd7e14, #ffc107);
    }
</style>



<div class="user-profile__dashboard-banner flex-center">
    <h1 class="h2 text-white">{{ __('account.dashboard') }}</h1>
</div>
<div class="user-profile__box user-dashboard__section p-3 bg-transparent rounded-top-0">
    <div class="row g-3 user-dashboard__stats">

        <!-- TOTAL BOOKINGS -->
        <div class="col-xl-3 col-lg-4 col-md-6">
            <a href="#" class="dashboard-stat-card stat-total">
                <div class="stat-icon">
                    <i class="fa-solid fa-suitcase"></i>
                </div>
                <div class="stat-content">
                    <p class="stat-label">{{ __('account.total_bookings') }}</p>
                    <h3 class="stat-value">{{ $stats->total_bookings ?? 0 }}</h3>
                </div>
            </a>
        </div>

        <!-- COMPLETED -->
        <div class="col-xl-3 col-lg-4 col-md-6">
            <a href="#" class="dashboard-stat-card stat-success">
                <div class="stat-icon">
                    <i class="fa-solid fa-circle-check"></i>
                </div>
                <div class="stat-content">
                    <p class="stat-label">{{ __('account.completed_trips') }}</p>
                    <h3 class="stat-value">{{ $stats->completed_bookings ?? 0 }}</h3>
                </div>
            </a>
        </div>

        <!-- CANCELLED -->
        <div class="col-xl-3 col-lg-4 col-md-6">
            <a href="#" class="dashboard-stat-card stat-danger">
                <div class="stat-icon">
                    <i class="fa-solid fa-ban"></i>
                </div>
                <div class="stat-content">
                    <p class="stat-label">{{ __('account.cancelled') }}</p>
                    <h3 class="stat-value">{{ $stats->cancelled_bookings ?? 0 }}</h3>
                </div>
            </a>
        </div>

        <!-- UPCOMING -->
        <div class="col-xl-3 col-lg-4 col-md-6">
            <a href="#" class="dashboard-stat-card stat-warning">
                <div class="stat-icon">
                    <i class="fa-solid fa-plane-departure"></i>
                </div>
                <div class="stat-content">
                    <p class="stat-label">{{ __('account.upcoming_trips') }}</p>
                    <h3 class="stat-value">{{ $stats->upcoming_bookings ?? 0 }}</h3>
                </div>
            </a>
        </div>

    </div>
</div>
