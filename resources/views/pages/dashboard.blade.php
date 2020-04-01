@extends('layouts.default')

@section('breadcrumbs')
    <div class="container-fluid">
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
        </ul>
    </div>
@endsection

@section('content')
<section class="no-padding-top no-padding-bottom">
    <div class="row">
        <div class="col-lg-12">
            <div class="block margin-bottom-sm">
                <div class="title"><strong>My Expenses</strong></div>

                <div>
                    @if (auth()->user()->expenses->first())
                    <table>
                      <thead>
                      <tr>
                          <th>Expense Categories</th>
                          <th>Total</th>
                      </tr>
                      </thead>
                      <tbody>
                        @foreach (auth()->user()->expenses as $expense)
                          <tr>
                            <td>{{ $expense->category->name }}</td>
                            <td>${{ number_format($expense->amount, 2) }}</td>
                          </tr>
                        @endforeach
                      </tbody>
                    </table>

                    <div class="chart-container">
                      <canvas id="pie-chart"></canvas>
                    </div>
                    @else
                      <div>Input data first.</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('scripts')
    
<script>
    new Chart(document.getElementById("pie-chart"), {
        type: 'pie',
        data: {
        labels: {!! \App\Expenses::join('expense_categories', 'expenses.expense_category_id', '=', 'expense_categories.id')->where('user_id', auth()->user()->id)->pluck('name') !!},
        datasets: [{
            label: "",
            backgroundColor: ["#3e95cd", "#8e5ea2", '#F1C40F', '#99A3A4', '#9B59B6', '#7FB3D5'],
            data: {!! \App\Expenses::select('amount')->where('user_id', auth()->user()->id)->pluck('amount') !!}
        }]
        },
        options: {
            maintainAspectRatio: false,
            responsive: true
        }
    });
</script>    
@endsection