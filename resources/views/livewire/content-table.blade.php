<div>
    <!-- Striped rows -->
    <table class="table p-20 mt-20 table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Pub Date</th>
                <th>CONTENT</th>
                <th>THEME</th>
                <th>KEYWORDS</th>
                <th>BUYER JOURNEY</th>
                <th>OBJECTIVES</th>
                <th>BUYER PERSONA</th>
                <th>CTA</th>
                <th>Added To</th>
                <th>Created</th>
                <th>Updated</th>
                <th class="text-right">ACTIONS</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($contents as $content)
                <tr>
                    <th>{{ $content->id }}</th>
                    <td>{{ $content->publicationdate }}</td>
                    <td>{{ $content->content }}</td>
                    <td>{{ $content->theme }}</td>
                    <td>{{ $content->keywords }}</td>
                    <td>{{ $content->buyerJourney }}</td>
                    <td>{{ $content->objective }}</td>
                    <td>{{ $content->buyerpersona }}</td>
                    <td>{{ $content->cta }}</td>
                    <td>{{ $content->addedto }}</td>
                    <td>{{ $content->created_at }}</td>
                    <td>{{ $content->updated_at }}</td>
                    <td class="text-right">
                        <button class="w-full m-5 btn btn-primary" type="button">EDIT</button>
                        <button class="w-full m-5 btn btn-danger" type="button">DELETE</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $contents->links( 'components.custom-pagination-links-view') }}

</div>
