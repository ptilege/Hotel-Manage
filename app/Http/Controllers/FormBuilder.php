<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class FormBuilder extends Controller
{
    public function buildForm(Request $request)
    {
        $this->createFile($request, $this->fileContent($request));
        // dd("File Created Success");
        // dd($request);
        return back();
    }

    public function createFile(Request $request, $data)
    {
        $file = $request->title . '.vue';
        $savePath = public_path() . "/generated-file/vue/";
        if (!is_dir($savePath)) {
            mkdir($savePath, 0777, true);
        }
        File::put($savePath . $file, $data);
    }

    public function fileContent(Request $request)
    {
        $content = "";

        // top content
        $content .= "<template>
        <AppLayout>
            <div class=\"row\">
                <div class=\"col-md-12\">
                    <div class=\"card mb-4\">
                        <div class=\"card-header pb-0\">
                            <h5>" . ($request->title != null ? $request->title : 'Add Title Here') . "</h5>
                            <p>" . ($request->subtitle != null ? $request->subtitle : 'Add Subtitle Here') . ".</p>
                        </div>
                        <hr />
                        <div class=\"card-body\">
                            <form id=\"\" class=\"form\" @submit.prevent=\"submit\">
                                <div class=\"row\">";

        // set fields
        foreach ($request->group as $key => $value) {
            if ($value['field_type'] == 'text' || $value['field_type'] == 'email' || $value['field_type'] == 'number') {
                $content .= "<InputComponent
                id=\"" . $value['field_id'] . "\"
                type=\"" . $value['field_type'] . "\"
                " . ($value['field_placeholder'] != null ? 'placeholder="' . $value['field_placeholder'] . '"' : '') . "
                label=\"" . $value['field_name'] . "\"
                " . ($value['field_required'] != 'yes' ? ':isRequired="true"' : '') . "
                :error=\"form.errors." . $value['field_id'] . "\"
                v-model=\"form." . $value['field_id'] . "\"
            />";
            }

            if ($value['field_type'] == 'select') {
                $content .= "<SelectInputComponent
                id=\"" . $value['field_id'] . "\"
                label=\"" . $value['field_name'] . "\"
                :error=\"form.errors." . $value['field_id'] . "\"
                :options=\"[]\"
                v-model=\"form." . $value['field_id'] . "\"
            />";
            }

            if ($value['field_type'] == 'file') {
            }
        }

        // bottom content
        $content .= "</div>
                        <div class=\"mt-2\">
                            <button
                                type=\"submit\"
                                class=\"btn btn-primary me-2\"
                                :disabled=\"form.processing\"
                            >
                                {{ %data% ? \"Update\" : \"Save\" }}
                            </button>
                        </div>
                    </form>
                </div>
                </div>
                </div>
                </div>
                </AppLayout>
                </template>";

        // scripts
        $content .= "<script>
        import { Link, useForm } from \"@inertiajs/inertia-vue3\";
        import AppLayout from \"@/Layouts/AppLayout\";
        import FileInputComponent from \"@/Components/FileInputComponent.vue\";
import InputComponent from \"@/Components/InputComponent.vue\";
import SelectInputComponent from \"@/Components/SelectInputComponent.vue\";
export default {";
        // components
        $content .= "    components: {
        Link,
        AppLayout,
        InputComponent,
        FileInputComponent,
        SelectInputComponent,
    },";

        // props
        $content .= "    props: {
        errors: Object,
        %data%: Object,
    },";

        // data
        $content .= "    data() {
        return {
            form: useForm({";

        foreach ($request->group as $key => $value) {
            $content .= $value['field_id'] . ":\"\"";
        }
        $content .= "}),
                };
                },";

        // mounted 
        $content .= "    mounted() {
        let self = this;
        if (this.%data%) {";
        foreach ($request->group as $key => $value) {
            $content .= "this.form." . $value['field_id'] . " = this.%data%." . $value['field_id'] . ";";
        }
        $content .= "        }
},";

        // methods
        $content .= "methods: {
    submit() {
        this.form.post(
            this.frontendUser
                ? route(\"routeName.update\")
                : route(\"routeName.store\"),
            {
                onSuccess: () => {
                    this.form.reset();
                    this.\$root.showMessage(
                        \"success\",
                        '<span class=\"text-success\">Success</span><br/>',
                        \"A Record Was Created Successfully! \"
                    );
                },
                onError: () => {
                    this.form.reset(\"add field names here\");
                    this.\$root.showMessage(
                        \"error\",
                        '<span class=\"text-danger\">Error</span><br>',
                        \"Something went wrong! \"
                    );
                },
            }
        );
    },";

        $content .= "    },
};
</script>";

        return $content;
    }
}
