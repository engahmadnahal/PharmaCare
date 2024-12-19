<!DOCTYPE html>
<html>

<head>
    <style>
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        td,
        th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #dddddd;
        }
    </style>
</head>

<body>
    <div>

        <h2 style="text-align: center">{{__('cms.store_report')}}</h2>
    </div>
    <div>
        <p @if (app()->getlocale() == 'ar')
            style="text-align:right;"
            @else
            style="text-align: left;"
            @endif >{{__('cms.this_info_for_stores')}}:</p>
    </div>

    <table>
        <tr>
            <th>{{__('cms.name')}}</th>
            <th>{{__('cms.address')}}</th>
            <th>{{__('cms.email')}}</th>
            <th>{{__('cms.mobile')}}</th>
            <th>{{__('cms.category_store')}}</th>
            <th>{{__('cms.work_days')}}</th>
            <th>{{__('cms.active')}}</th>
            <th>{{__('cms.create')}}</th>
            <th>{{__('cms.craeted_at')}}</th>
        </tr>
        @foreach ($data as $store)
        <tr>
            <td>{{$store->name
                ?? ''}}</td>
            <td>{{$store->address}}</td>
            <td>{{$store->email}}</td>
            <td>{{$store->mobile}}</td>
            <td>{{$store->categories->count()}}</td>
            <td>{{$store->dayWorks->count()}}</td>

            <td>{{$store->active_key}}</td>
            <td>{{$store->created_at->diffForHumans()}}</td>
            <td>{{$store->created_at->format('d/m/Y')}}</td>
        </tr>
        @endforeach
    </table>
</body>

</html>