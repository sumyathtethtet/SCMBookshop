<!DOCTYPE html>
<html>
<head>
    <title>Welcome Email</title>
</head>
<body>
    <h3>Hello, I would like to order the following books</h3>
    <table>
        <thead>
            <tr>
                <th>Book-Name</th>
                <th>Quantity</th>
            </tr>
        </thead>
        <tbody>
            @if(count($book) > 0)
                @foreach($book as $b)
                    @if(count($b) > 0)
                    <tr>
                        <td>{{isset($b->name) ? $b->name: '' }}</td>
                        <td>{{isset($b->quantity) ? $b->quantity: '' }}</td>
                    </tr>
                    @endif
                @endforeach
            @endif
    </table>
    <h3>Here is my info</h3>
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Phone<th>
            </tr>
        </thead>
        <tbody>
                <tr>
                    <td>{{ Auth::user()->name }}</td>
                    <td>{{ Auth::user()->email }}</td>
                    <td>{{ Auth::user()->phone }}</td>
                </tr>
        </tbody>
    </table>
    <h3>Best Regards</h3>
        <h4>{{ Auth::user()->name }}</h4>
</body>
</html>