@extends('expense::layouts.master')

@section('content')
    <div class="container" id="expenses">
        <br />
        <div class="d-flex justify-content-between mb-2">
            <h4 class="mb-1 pb-1 fz-28">Expenses</h4>
            <span>
                <a href="{{ route('expense.create') }}" class="btn btn-success text-white">Add new expense</a>
                <a href="{{ route('expense.recurring.index') }}" class="btn btn-info text-white">Setup Recurring Expense</a>

            </span>
        </div>
        <table class="table table-striped table-bordered">
            <tr>
                <th>Name</th>
                <th>Amount</th>
                <th>Category</th>
                <th>Location</th>
                <th>Uploaded by</th>
                <th>Paid on</th>
            </tr>
            @foreach ($expenses as $expense)
                <tr>
                    <td>{{ $expense->name }}</td>
                    <td>{{ $expense->amount }}</td>
                    <td>{{ Str::headline($expense->category) }}</td>
                    <td>{{ Str::headline($expense->location) }}</td>
                    <td>{{ $expense->uploaded_by }}</td>
                    <td>{{ $expense->paid_at->format('d-M-Y') }}</td>
                </tr>
            @endforeach
        </table>
        {{$expenses->links()}}
    </div>
@endsection
