@extends('cms.parent')

@section('page-name',__('cms.users'))
@section('main-page',__('cms.hr'))
@section('sub-page',__('cms.users'))
@section('page-name-small',__('cms.index'))

@section('styles')
<style>
    .status-switch .form-check-input {
        width: 45px;
        height: 24px;
    }
    .status-switch .form-check-input:checked {
        background-color: #50CD89;
        border-color: #50CD89;
    }
</style>
@endsection

@section('content')
<div class="card card-custom gutter-b">
    <div class="card-header border-0 py-5">
        <h3 class="card-title align-items-start flex-column">
            <span class="card-label font-weight-bolder text-dark">{{__('cms.users')}}</span>
        </h3>
    </div>
    <div class="card-body py-0">
        <div class="table-responsive">
            <table class="table table-head-custom table-vertical-center" id="kt_advance_table_widget_2">
                <thead>
                    <tr class="text-uppercase">
                        <th>{{__('cms.full_name')}}</th>
                        <th>{{__('cms.email')}}</th>
                        <th>{{__('cms.mobile')}}</th>
                        <th>{{__('cms.created_at')}}</th>
                        <th>{{__('cms.status')}}</th>
                        <th>{{__('cms.actions')}}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($data as $user)
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="symbol symbol-40 symbol-light-success mr-5">
                                    @if($user->image)
                                        <img src="{{ Storage::url($user->image) }}" alt=""/>
                                    @else
                                        <span class="symbol-label font-size-h4">
                                            {{ substr($user->full_name, 0, 1) }}
                                        </span>
                                    @endif
                                </div>
                                <div class="ml-3">
                                    <span class="text-dark-75 font-weight-bold line-height-sm d-block pb-2">
                                        {{ $user->full_name }}
                                    </span>
                                </div>
                            </div>
                        </td>
                        <td>
                            <a href="mailto:{{ $user->email }}" class="text-dark-75 font-weight-bold text-hover-primary">
                                {{ $user->email }}
                            </a>
                        </td>
                        <td>
                            <a href="tel:{{ $user->mobile }}" class="text-dark-75 font-weight-bold text-hover-primary">
                                {{ $user->mobile }}
                            </a>
                        </td>
                        <td>
                            <span class="text-dark-75 font-weight-bold">
                                {{ $user->created_at->format('Y-m-d') }}
                            </span>
                        </td>
                        <td>
                            <div class="status-switch">
                                <label class="switch">
                                    <input type="checkbox" 
                                        id="status_{{ $user->id }}"
                                        onchange="updateStatus('{{ $user->id }}')"
                                        @checked($user->status)>
                                    <span class="slider round"></span>
                                </label>
                            </div>
                        </td>
                        <td>
                            <a href="{{ route('users.show', $user->id) }}" 
                                class="btn btn-icon btn-light btn-hover-primary btn-sm">
                                <span class="svg-icon svg-icon-primary svg-icon-2x">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <path d="M12 4.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5zM12 17c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5zm0-8c-1.66 0-3 1.34-3 3s1.34 3 3 3 3-1.34 3-3-1.34-3-3-3z" fill="currentColor"/>
                                    </svg>
                                </span>
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center">
                            {{__('cms.no_records')}}
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($data->hasPages())
        <div class="card-footer">
            {{ $data->links() }}
        </div>
        @endif
    </div>
</div>
@endsection

@section('scripts')
<script>
function updateStatus(userId) {
    const checkbox = document.getElementById('status_' + userId);
    
    axios.put(`/cms/employee/users/${userId}/status`)
    .then(function (response) {
        toastr.success(response.data.message);
    })
    .catch(function (error) {
        toastr.error(error.response.data.message);
        checkbox.checked = !checkbox.checked;
    });
}
</script>
@endsection