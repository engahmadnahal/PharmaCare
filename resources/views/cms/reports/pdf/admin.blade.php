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

        <h2 style="text-align: center">{{__('cms.admin_report')}}</h2>
    </div>
    <div>
        <p @if (app()->getlocale() == 'ar')
            style="text-align:right;"
            @else
            style="text-align: left;"
            @endif >{{__('cms.this_info_for_admins')}}:</p>
    </div>

    <table>
        <tr>
            <th>{{__('cms.full_name')}}</th>
            <th>{{__('cms.user_name')}}</th>
            <th>{{__('cms.email')}}</th>
            <th>{{__('cms.verified')}}</th>
            <th>{{__('cms.account_status')}}</th>
            <th>{{__('cms.create')}}</th>
            <th>{{__('cms.craeted_at')}}</th>
        </tr>
        @foreach ($data as $admin)
        <tr>
            <td>{{$admin->name}}</td>
            <td>{{$admin->user_name}}</td>
            <td>{{$admin->email}}</td>
            <td>{{!is_null($admin->email_verifier_at) ?
                __('cms.verified')
                :__('cms.not_verified')}}</td>
            <td>{{$admin->active_key}}</td>
            <td>{{$admin->created_at->diffForHumans()}}</td>
            <td>{{$admin->created_at->format('d/m/Y')}}</td>
        </tr>
        @endforeach
    </table>
</body>

</html>