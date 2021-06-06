<table class="table table-striped" id="emp_table">
    <thead>
        <tr>
            <th class="text-right" scope="col">#</th>
            <th class="text-right" scope="col">الرقم الوظيفي</th>
            <th class="text-right" scope="col">الإسم</th>
            <th class="text-right" scope="col">تاريخ التسجيل</th>

        </tr>
    </thead>
    <tbody>
        @foreach($employees as $emp)

        <tr>
            <th class="text-right" scope="row">{{$loop->iteration}}</th>
            <th class="text-right" scope="row">{{$emp->EMP_ID}}</th>
            <td class="text-right">{{ $emp->EMP_NAME}}
            <td class="text-right">{{ $emp->created_at->format('y-m-d') }}
            </td>

        </tr>
        @endforeach
    </tbody>
</table>