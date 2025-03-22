@extends('cms.parent')

@section('page-name', __('cms.users'))
@section('main-page', __('cms.hr'))
@section('sub-page', __('cms.users'))
@section('page-name-small', __('cms.show'))

@section('styles')

@endsection

@section('content')
<div class="d-flex flex-column gap-7 gap-lg-10">
    <!-- User Basic Info Card -->
    <div class="card card-flush">
        <div class="card-header">
            <div class="card-title">
                <h2>{{ __('cms.user_information') }}</h2>
            </div>
        </div>
        <div class="card-body pt-0">
            <div class="row">
                <div class="col-xl-3 text-center">
                    <div class="symbol symbol-100px symbol-circle mb-7">
                        @if($user->image)
                            <img src="{{ Storage::url($user->image) }}" alt=""/>
                        @else
                            <div class="symbol-label fs-3 bg-light-primary text-primary">
                                {{ substr($user->name, 0, 1) }}
                            </div>
                        @endif
                    </div>
                </div>
                <div class="col-xl-9">
                    <div class="row g-5 g-xl-8">
                        <div class="col-md-6">
                            <div class="fw-bold mt-5">{{ __('cms.name') }}</div>
                            <div class="text-gray-600">{{ $user->name }}</div>
                        </div>
                        <div class="col-md-6">
                            <div class="fw-bold mt-5">{{ __('cms.email') }}</div>
                            <div class="text-gray-600">{{ $user->email }}</div>
                        </div>
                        <div class="col-md-6">
                            <div class="fw-bold mt-5">{{ __('cms.mobile') }}</div>
                            <div class="text-gray-600">{{ $user->mobile }}</div>
                        </div>
                        <div class="col-md-6">
                            <div class="fw-bold mt-5">{{ __('cms.created_at') }}</div>
                            <div class="text-gray-600">{{ $user->created_at->format('Y-m-d') }}</div>
                        </div>
                        <div class="col-md-6">
                            <div class="fw-bold mt-5">{{ __('cms.status') }}</div>
                            <div class="badge badge-{{ $user->status ? 'success' : 'danger' }}">
                                {{ $user->status ? __('cms.active') : __('cms.inactive') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Medical Information Card -->
    <div class="card card-flush">
        <div class="card-header">
            <div class="card-title">
                <h2>{{ __('cms.medical_information') }}</h2>
            </div>
        </div>
        <div class="card-body pt-0">
            <div class="row g-5 g-xl-8">
                <div class="col-md-4">
                    <div class="fw-bold mt-5">{{ __('cms.blood_type') }}</div>
                    <div class="text-gray-600">{{ $user->info?->blood_type ?? '-' }}</div>
                </div>
                <div class="col-md-4">
                    <div class="fw-bold mt-5">{{ __('cms.width') }}</div>
                    <div class="text-gray-600">{{ $user->info?->width ?? '-' }}</div>
                </div>
                <div class="col-md-4">
                    <div class="fw-bold mt-5">{{ __('cms.length') }}</div>
                    <div class="text-gray-600">{{ $user->info?->length ?? '-' }}</div>
                </div>
                <div class="col-md-6">
                    <div class="fw-bold mt-5">{{ __('cms.allergies') }}</div>
                    <div class="text-gray-600">
                        @if($user->info?->is_allergies)
                            <span class="badge badge-warning">{{ __('cms.' . ($user->info?->allergies ?? 'none')) }}</span>
                        @else
                            <span class="badge badge-success">{{ __('cms.no_allergies') }}</span>
                        @endif
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="fw-bold mt-5">{{ __('cms.genetic_diseases') }}</div>
                    <div class="text-gray-600">
                        @if($user->info?->is_genetic_diseases)
                            <span class="badge badge-warning">{{ __('cms.' . ($user->info?->genetic_diseases ?? 'none')) }}</span>
                        @else
                            <span class="badge badge-success">{{ __('cms.no_genetic_diseases') }}</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Drugs Card -->
    <div class="card card-flush">
        <div class="card-header">
            <div class="card-title">
                <h2>{{ __('cms.drugs') }}</h2>
            </div>
        </div>
        <div class="card-body pt-0">
            <div class="table-responsive">
                <table class="table table-row-bordered table-row-gray-100 align-middle gs-0 gy-3">
                    <thead>
                        <tr class="fw-bold text-muted">
                            <th>{{ __('cms.name') }}</th>
                            <th>{{ __('cms.dosage') }}</th>
                            <th>{{ __('cms.diseases') }}</th>
                            <th>{{ __('cms.duration') }}</th>
                            <th>{{ __('cms.type') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($user->drugs as $drug)
                        <tr>
                            <td>{{ $drug->name }}</td>
                            <td>{{ $drug->dosage }}</td>
                            <td>{{ $drug->diseases }}</td>
                            <td>{{ $drug->duration ?? '-' }}</td>
                            <td>
                                <span class="badge badge-{{ $drug->type == 'permanent' ? 'danger' : 'warning' }}">
                                    {{ __('cms.' . $drug->type) }}
                                </span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center">{{ __('cms.no_records') }}</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Medical Records Card -->
    <div class="card card-flush">
        <div class="card-header">
            <div class="card-title">
                <h2>{{ __('cms.medical_records') }}</h2>
            </div>
        </div>
        <div class="card-body pt-0">
            <div class="table-responsive">
                <table class="table table-row-bordered table-row-gray-100 align-middle gs-0 gy-3">
                    <thead>
                        <tr class="fw-bold text-muted">
                            <th>{{ __('cms.name') }}</th>
                            <th>{{ __('cms.description') }}</th>
                            <th>{{ __('cms.type') }}</th>
                            <th>{{ __('cms.file') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($user->medicalRecords as $record)
                        <tr>
                            <td>{{ $record->name }}</td>
                            <td>{{ $record->description }}</td>
                            <td>{{ $record->type }}</td>
                            <td>
                                @if($record->file)
                                <a href="{{ Storage::url($record->file) }}" target="_blank" class="btn btn-sm btn-light-primary">
                                    {{ __('cms.view_file') }}
                                </a>
                                @else
                                -
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center">{{ __('cms.no_records') }}</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Orders Card -->
    <div class="card card-flush">
        <div class="card-header">
            <div class="card-title">
                <h2>{{ __('cms.orders') }}</h2>
            </div>
        </div>
        <div class="card-body pt-0">
            <!-- Orders Statistics -->
            <div class="row g-5 g-xl-8 mb-5">
                <div class="col-md-3">
                    <div class="card bg-light-primary card-xl-stretch mb-xl-8">
                        <div class="card-body">
                            <span class="text-primary fw-bold fs-6">{{ __('cms.total_orders') }}</span>
                            <div class="fw-bolder text-primary fs-2">{{ $orderStats['total_orders'] }}</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card bg-light-success card-xl-stretch mb-xl-8">
                        <div class="card-body">
                            <span class="text-success fw-bold fs-6">{{ __('cms.completed_orders') }}</span>
                            <div class="fw-bolder text-success fs-2">{{ $orderStats['completed_orders'] }}</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card bg-light-warning card-xl-stretch mb-xl-8">
                        <div class="card-body">
                            <span class="text-warning fw-bold fs-6">{{ __('cms.pending_orders') }}</span>
                            <div class="fw-bolder text-warning fs-2">{{ $orderStats['pending_orders'] }}</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card bg-light-info card-xl-stretch mb-xl-8">
                        <div class="card-body">
                            <span class="text-info fw-bold fs-6">{{ __('cms.total_spent') }}</span>
                            <div class="fw-bolder text-info fs-2">{{ $orderStats['total_spent'] }}</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Orders Table -->
            <div class="table-responsive">
                <table class="table table-row-bordered table-row-gray-100 align-middle gs-0 gy-3">
                    <thead>
                        <tr class="fw-bold text-muted">
                            <th>{{ __('cms.order_number') }}</th>
                            <th>{{ __('cms.total') }}</th>
                            <th>{{ __('cms.items_count') }}</th>
                            <th>{{ __('cms.status') }}</th>
                            <th>{{ __('cms.actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($user->orders as $order)
                        <tr>
                            <td>{{ $order->order_num }}</td>
                            <td>{{ $order->total }}</td>
                            <td>{{ $order->items_count }}</td>
                            <td>
                                <span class="badge badge-{{ $order->status_color }}">
                                    {{ __('cms.' . $order->status) }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('orders.show', $order->id) }}" class="btn btn-sm btn-light-primary">
                                    {{ __('cms.view') }}
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center">{{ __('cms.no_records') }}</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script src="{{ asset('assets/js/pages/widgets.js') }}"></script>
    <script>
        function performDestroy(id, reference) {
            confirmDestroy('/cms/admin/users', id, reference);
        }
    </script>
@endsection
