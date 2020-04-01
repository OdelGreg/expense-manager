@extends('layouts.default')

@section('head_js')
    <script type="text/x-template" id="modal-template">
        <transition name="modal">
            <div class="modal-mask">
              <div class="modal-wrapper">
                <div class="modal-container">

                  <div class="modal-header">
                    <slot name="header">
                    </slot>
                  </div>

                  <div class="modal-body">
                      <slot name="body">
                      </slot>
                  </div>
                </div>
              </div>
            </div>
        </transition>
    </script>
@endsection

@section('breadcrumbs')
    <div class="container-fluid">
        <ul class="breadcrumb">
            <li class="breadcrumb-item">Expense Management</li>
            <li class="breadcrumb-item">Expenses</li>
        </ul>
    </div>
@endsection

@section('content')
<section class="no-padding-top no-padding-bottom">
    <div class="row">
        @if(session()->has('notice'))
          <div class="alert alert-success">
             {{ session()->get('notice') }}
          </div>
        @endif

        @if ($errors->has('expense_category_id'))
            <div class="invalid-feedback d-block" role="alert">
                <strong>{{ $errors->first('expense_category_id') }}</strong>
            </div>
        @endif

        @if ($errors->has('amount'))
            <div class="invalid-feedback d-block" role="alert">
                <strong>{{ $errors->first('amount') }}</strong>
            </div>
        @endif

        @if ($errors->has('entry_date'))
            <div class="invalid-feedback d-block" role="alert">
                <strong>{{ $errors->first('entry_date') }}</strong>
            </div>
        @endif

        <div class="col-lg-12">
            <div class="block margin-bottom-sm">
                <div class="title"><strong>Expenses</strong></div>

                <div>
                    @if ($expenses->first())
                      <table class="table">
                        <thead>
                        <tr>
                            <th>Expense Category</th>
                            <th>Amount</th>
                            <th>Entry Date</th>
                            <th>Created at</th>
                        </tr>
                        </thead>
                        <tbody>                          
                          @foreach ($expenses as $expense)
                            <tr>
                              <td id="update-{{ $loop->iteration }}">
                                <a class="modal-link" id="show-modal-update-{{ $loop->iteration }}" @click="showModalUpdate{{ $loop->iteration }} = true"><u>{{ $expense->category->name }}</u></a>

                                <modal v-if="showModalUpdate{{ $loop->iteration }}" @close="showModalUpdate{{ $loop->iteration }} = false">
                                    <h3 slot="header">Update Expense</h3>

                                    <div slot="body">
                                      <form action="/expenses/update" method="post">
                                        {{ csrf_field() }}
                                        <input name="id" type="hidden" value="{{ $expense->id }}">

                                        <div>
                                          <label>Expense Category</label>
                                          <select name="expense_category_id">
                                            @foreach ($expenseCategories as $category)
                                              <option value="{{ $category->id }}" {{ ($expense->category->id == $category->id) ? 'selected' : '' }}>{{ $category->name }}</option>
                                            @endforeach
                                          </select>
                                        </div>

                                        <div>
                                          <label>Amount</label>
                                          <input name="amount" value="{{ $expense->amount }}">
                                        </div>

                                        <div>
                                          <label>Entry Date</label>
                                          <input name="entry_date" value="{{ $expense->entry_date }}">
                                        </div>

                                        <div>
                                          <input type="submit" name="delete" value="Delete">
                                          <input type="submit" v-on:click.prevent @click="showModalUpdate{{ $loop->iteration }} = false" value="Cancel">
                                          <input type="submit" name="submit" value="Update">
                                        </div>
                                      </form>
                                    </div>
                                </modal>
                              </td>
                              <td>${{ number_format($expense->amount, 2) }}</td>
                              <td>{{ $expense->entry_date }}</td>
                              <td>{{ $expense->created_at }}</td>
                              <script>
                                new Vue({
                                    el: "#update-{!! $loop->iteration !!}",
                                    data: {
                                        showModalUpdate{!! $loop->iteration !!}: false
                                    }
                                });
                              </script>
                            </tr>
                          @endforeach
                        </tbody>
                      </table>
                    @else
                      <div>Please input expenses first.</div>
                    @endif
                </div>

                <div id="add" class="d-flex align-items-end flex-column">
                    <button id="show-modal" @click="showModal = true">Add Expense</button>

                    <modal v-if="showModal" @close="showModal = false">
                        <h3 slot="header">Add Expense</h3>

                        <div slot="body">
                          <form action="/expenses/add" method="post">
                            {{ csrf_field() }}

                            <div>
                              <label>Expense Category</label>
                              <select name="expense_category_id">
                                @foreach ($expenseCategories as $category)
                                  <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                              </select>
                            </div>

                            <div>
                              <label>Amount</label>
                              <input name="amount">
                            </div>

                            <div>
                              <label>Entry Date</label>
                              <input name="entry_date">
                            </div>

                            <div>
                              <input type="submit" v-on:click.prevent @click="showModal = false" value="Cancel">
                              <input type="submit" name="submit" value="Save">
                            </div>
                          </form>
                        </div>
                    </modal>
                </div>

                
            </div>
        </div>
    </div>
</section>
@endsection

@section('scripts')
<script>
    Vue.component("modal", {
        template: "#modal-template"
    });

    // start app
    new Vue({
        el: "#add",
        data: {
            showModal: false
        }
    });
</script>    
@endsection