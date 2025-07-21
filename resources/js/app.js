import { resize } from "@alpinejs/resize";
import Alpine from "alpinejs";
import "./bootstrap";

Alpine.plugin(resize);

window.Alpine = Alpine;

Alpine.start();
