<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta http-equiv="X-UA-Compatible" content="ie=edge" />
        <title>Document</title>

        <link rel="stylesheet" type="text/css" href="{{asset('frontend/vendor/bootstrap/css/bootstrap.min.css')}}">
    </head>
    <body>
        <div class="container py-4">
            <div class="card">
                <h5 class="card-header">Form Builder</h5>
                <div class="card-body">
                    <form action="{{route('create-build-form')}}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input
                                type="text"
                                class="form-control"
                                id="title"
                                name="title"
                            />
                        </div>
                        <div class="form-group">
                            <label for="subtitle">Subtitle</label>
                            <input
                                type="text"
                                class="form-control"
                                id="subtitle"
                                name="subtitle"
                            />
                        </div>
                        <label for="subtitle">Fields</label>
                        <!-- repeater builder -->
                        <div id="repeater">
                            <div data-repeater-list="group">
                            <div class="card items" data-repeater-item>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-3">
                                            <div class="form-group">
                                                <label for="field_id"
                                                    >Field Id</label
                                                >
                                                <input
                                                    type="text"
                                                    class="form-control"
                                                    id="field_id"
                                                    name="field_id"
                                                />
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="form-group">
                                                <label for="field_name"
                                                    >Field Name</label
                                                >
                                                <input
                                                    type="text"
                                                    class="form-control"
                                                    id="field_name"
                                                    name="field_name"
                                                />
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="form-group">
                                                <label for="field_placeholder"
                                                    >Field Placeholder</label
                                                >
                                                <input
                                                    type="text"
                                                    class="form-control"
                                                    id="field_placeholder"
                                                    name="field_placeholder"
                                                />
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="form-group">
                                                <label for="field_type"
                                                    >Field Type</label
                                                >
                                                <select
                                                    class="form-control"
                                                    id="field_type"
                                                    name="field_type"
                                                >
                                                    <option value="text">
                                                        Text
                                                    </option>
                                                    <option value="select">
                                                        Select
                                                    </option>
                                                    <option value="number">
                                                        Number
                                                    </option>
                                                    <option value="email">
                                                        Email
                                                    </option>
                                                    <option value="textarea">
                                                        Textarea
                                                    </option>

                                                    <option value="file">
                                                        File Input
                                                    </option>
                                                    <option value="checkbox">
                                                        Checkbox
                                                    </option>
                                                    <option value="redio">
                                                        Radio
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="form-group">
                                                <label for="field_required"
                                                    >Field Required</label
                                                >
                                                <select
                                                    class="form-control"
                                                    id="field_required"
                                                    name="field_required"
                                                >
                                                    <option value="yes">
                                                        Yes
                                                    </option>
                                                    <option value="no">
                                                        No
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <button
                                        type="button"
                                        class="btn btn-danger"
                                        data-repeater-delete
                                    >
                                        Remove
                                    </button>
                                </div>
                            </div>
                        </div>
                            <button
                                class="btn btn-primary repeater-add-btn"
                                data-repeater-create
                            >
                                Add
                            </button>
                        </div>
                        <!-- repeater builder -->

                        <button class="btn btn-primary get-data">
                            Get repeater data
                        </button>
                        <button type="submit" class="btn btn-primary create">
                            Create
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <script src="{{asset('frontend/vendor/jquery/jquery.min.js')}}"></script>
        <script src="{{asset('frontend/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
        <script src="{{asset('frontend/jquery.repeater.js')}}"></script>

        <script>
            $(document).ready(function() {
                $("#repeater").repeater();

                $(this).on('click', '.repeater-add-btn', function(e) {
                    e.preventDefault();
                });

                $(this).on('click', '.get-data', function(e) {
                    e.preventDefault();
                    let values = $("#repeater").repeaterVal();
                    console.log(values);
                });
                $(this).on('click', '.create', function(e) {
                })
            })
        </script>
    </body>
</html>
