<div>
    <table class="table table-stripped table-sm ">
        <thead class="thead-light">
        <tr class="text-uppercase">
            <th>SECTION</th>
            <th class="text-center">NBRE ELEVENE</th>
            <th class="text-right">RECETTE ATTENDUE</th>
            <th class="text-right">RECETTE GENERE</th>
            <th class="text-center">POURCENTAGE</th>
        </tr>
        </thead>
        <tbody>
        @foreach($listSections as $section)
            <tr>
                <td>{{$section->name}}</td>
                <td class="text-center">{{$section->getStudentCount($section->id,$defaultScolaryYerId)}}</td>
                <td class="text-right">{{10*$section->getStudentCount($section->id,$defaultScolaryYerId) }}</td>
                <td class="text-right">{{$section->getPaymentCount($section->id,$defaultScolaryYerId)}}</td>
                <td>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
