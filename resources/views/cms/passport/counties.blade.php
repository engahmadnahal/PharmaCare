@extends('cms.parent')

@section('page-name',__('cms.countries'))
@section('main-page',__('cms.content_management'))
@section('sub-page',__('cms.countries'))
@section('page-name-small','countries')

@section('styles')

@endsection

@section('content')
<!--begin::Advance Table Widget 5-->
<div class="card card-custom gutter-b">
    <!--begin::Header-->
    <div class="card-header border-0 py-5">
        <h3 class="card-title align-items-start flex-column">
            <span class="text-muted mt-3 font-weight-bold font-size-sm"></span>
        </h3>
    </div>
    <!--end::Header-->
    <!--begin::Body-->
    <div class="card-body py-0">
        <!--begin::Table-->
        <div class="table-responsive">
            <table class="table table-head-custom table-vertical-center table-hover" id="kt_advance_table_widget_2">
                <thead>
                    <tr class="text-uppercase">
                        <th style="min-width: 150px">{{__('cms.name')}}</th>
                        <th style="min-width: 80px">{{__('cms.status')}}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $c)
                    <tr>
                        <td class="pl-0">
                            <a href="#"
                                class="text-dark-75 font-weight-bolder text-hover-primary font-size-lg">{{$c->name}}</a>
                        </td>
                        
                        <td class="pl-0">
                            <div class="checkbox-inline">
                                <label class="checkbox checkbox-success">
                                    <input type="checkbox" class="country" name="country"
                                    @if($c->assign)
                                        checked="checked"
                                    @endif 
                                    onclick="setCountry()" value="{{$c->id}}">
                                    <span></span>Set</label>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!--end::Table-->
    </div>
    <!--end::Body-->
</div>
<!--end::Advance Table Widget 5-->
@endsection

@section('scripts')
<script src="{{asset('assets/js/pages/widgets.js')}}"></script>
<script>
    function setCountry() {

        let countryId = [];
        let getCountryId = $("input:checkbox[name=country]:checked").each(function(){
            countryId.push($(this).val());
        });
        let data = {
            countryId: countryId,
        }
        store('/cms/admin/passport_types/{{$passportType->id}}/countries',data);
    }
</script>
@endsection