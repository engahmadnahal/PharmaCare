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

        <h2 style="text-align: center">{{__('cms.sub_sub_category_report')}}</h2>
    </div>
    <div>
        <p @if (app()->getlocale() == 'ar')
            style="text-align:right;"
            @else
            style="text-align: left;"
            @endif >{{__('cms.this_info_for_sub_sub_categories')}}:</p>
    </div>

    <table>
        <tr>
            <th>{{__('cms.name')}}</th>
            <th>{{__('cms.code')}}</th>
            <th>{{__('cms.category')}}</th>
            <th>{{__('cms.sub_category')}}</th>
            <th>{{__('cms.products')}}</th>
            <th>{{__('cms.translations')}}</th>
            <th>{{__('cms.active')}}</th>
            <th>{{__('cms.create')}}</th>
            <th>{{__('cms.craeted_at')}}</th>
        </tr>
        @foreach ($data as $subSubCategory)
        <tr>
            <td>{{$subSubCategory->translations->first()?->name
                ?? ''}}</td>
            <td>{{$subSubCategory->code}}</td>
            <td>{{$subSubCategory->subCategory->category->name}}</td>
            <td>{{$subSubCategory->subCategory->name}}</td>
            <td>{{$subSubCategory->products_count}}</td>
            <td>{{$subSubCategory->translations_count}}</td>
            <td>{{$subSubCategory->active_key}}</td>
            <td>{{$subSubCategory->created_at->diffForHumans()}}</td>
            <td>{{$subSubCategory->created_at->format('d/m/Y')}}</td>
        </tr>
        @endforeach
    </table>
</body>

</html>