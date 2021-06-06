<table class="table table-striped" >
    <thead>
    <tr>
        <th class="text-right" scope="col">#</th>
        <th class="text-right" scope="col">#الرقم الوظيفي</th>
        <th class="text-right" scope="col">الحالة</th>
        <th class="text-right" scope="col">الوقت</th>

    </tr>
    </thead>
    <tbody>
    @foreach($presence as $row)

        <tr>
            <th class="text-right" scope="row">{{$loop->iteration}}</th>
            <th class="text-right" scope="row">{{$row->employee_id}}</th>
            <td class="text-right"><span class="{{$row->status=="C/In"?"badge badge-success":"badge badge-primary"}}">
                            {{$row->status=="C/In"?"تسجيل دخول":"تسجيل خروج"}}
                        </span> </td>
            <td class="text-right">{{ $row->created_at->format('h:i') }}
            </td>

        </tr>
    @endforeach
    </tbody>
</table>
