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
            <li class="breadcrumb-item">User Management</li>
            <li class="breadcrumb-item">Roles</li>
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

        @if ($errors->has('name'))
            <div class="invalid-feedback d-block" role="alert">
                <strong>{{ $errors->first('name') }}</strong>
            </div>
        @endif

        @if ($errors->has('description'))
            <div class="invalid-feedback d-block" role="alert">
                <strong>{{ $errors->first('description') }}</strong>
            </div>
        @endif

        <div class="col-lg-12">
            <div class="block margin-bottom-sm">
                <div class="title"><strong>Roles</strong></div>

                <div>
                    <table class="table">
                      <thead>
                      <tr>
                          <th>Display Name</th>
                          <th>Description</th>
                          <th>Created at</th>
                      </tr>
                      </thead>
                      <tbody>                          
                        @foreach ($roles as $role)
                          <tr>
                            <td id="update-{{ $loop->iteration }}">
                              <a class="modal-link" id="show-modal-update-{{ $loop->iteration }}" @click="showModalUpdate{{ $loop->iteration }} = true"><u>{{ $role->name }}</u></a>

                              <modal v-if="showModalUpdate{{ $loop->iteration }}" @close="showModalUpdate{{ $loop->iteration }} = false">
                                  <h3 slot="header">Update Role</h3>

                                  <div slot="body">
                                    <form action="/roles/update" method="post">
                                      {{ csrf_field() }}
                                      <input name="id" type="hidden" value="{{ $role->id }}">

                                      <div>
                                        <label>Display Name</label>
                                        <input name="name" value="{{ $role->name }}">
                                      </div>
                                      <div>
                                        <label>Description</label>
                                        <input name="description" value="{{ $role->description }}">
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
                            <td>{{ $role->description }}</td>
                            <td>{{ $role->created_at }}</td>
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
                </div>

                <div id="add" class="d-flex align-items-end flex-column">
                    <button id="show-modal" @click="showModal = true">Add Role</button>

                    <modal v-if="showModal" @close="showModal = false">
                        <h3 slot="header">Add Role</h3>

                        <div slot="body">
                          <form action="/roles/add" method="post">
                            {{ csrf_field() }}
                            <div>
                              <label>Display Name</label>
                              <input name="name">
                            </div>
                            <div>
                              <label>Description</label>
                              <input name="description">
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