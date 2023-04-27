@extends('layouts.layout')
@section('content')
<div class="container mt-5">
        <div class="card">
            <div class="card-header">
                Chat Room
            </div>
            <div class="card-body" style="height: 400px; overflow-y: auto;">
                <div class="row mb-2">
                    <div class="col-12">
                        <strong>User 1:</strong> Hello, everyone!
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-12">
                        <strong>User 2:</strong> Hi, User 1! How are you?
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-12">
                        <strong>User 1:</strong> I'm doing great, thanks for asking!
                    </div>
                </div>
                <!-- Add more messages here -->
            </div>
            <div class="card-footer">
                <form>
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Type your message...">
                        <button class="btn btn-primary" type="submit">Send</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
