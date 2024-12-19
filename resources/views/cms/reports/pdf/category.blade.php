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

        <h2 style="text-align: center">{{__('cms.category_report')}}</h2>
    </div>
    <div>
        <p @if (app()->getlocale() == 'ar')
            style="text-align:right;"
            @else
            style="text-align: left;"
            @endif >{{__('cms.this_info_for_categories')}}:</p>
    </div>

    <table>
        <tr>
            <th>{{__('cms.name')}}</th>
            <th>{{__('cms.code')}}</th>
            <th>{{__('cms.translations')}}</th>
            <th>{{__('cms.sub_categories')}}</th>
            <th>{{__('cms.active')}}</th>
            <th>{{__('cms.create')}}</th>
            <th>{{__('cms.craeted_at')}}</th>
        </tr>
        @foreach ($data as $category)
        <tr>
            <td>{{$category->translations->first()?->name
                ?? ''}}</td>
            <td>{{$category->code}}</td>
            <td>{{$category->translations_count}}</td>
            <td>{{$category->sub_categories_count}}</td>
            <td>{{$category->active_key}}</td>
            <td>{{$category->created_at->diffForHumans()}}</td>
            <td>{{$category->created_at->format('d/m/Y')}}</td>
        </tr>
        @endforeach
    </table>
</body>

</html>