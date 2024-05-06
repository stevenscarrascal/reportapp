<div class="btn-group" role="group" aria-label="Basic example">
<a href="{{route('coordinador.show',$value)}}" class="btn text-success"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14" id="Visible--Streamline-Core"><desc>Visible Streamline Icon: https://streamlinehq.com</desc><g id="visible--eye-eyeball-open-view"><path id="Subtract" fill="#000000" fill-rule="evenodd" d="M2.9327 3.49099C4.0559 2.68177 5.4556 2 7 2c1.54441 0 2.9441 0.68177 4.0673 1.49099 1.1273 0.81215 2.0197 1.78397 2.5599 2.4369l0.0045 0.00553c0.2413 0.3002 0.3683 0.68062 0.3683 1.06664 0 0.38601 -0.127 0.76644 -0.3683 1.06664l-0.0045 0.00553c-0.5402 0.65292 -1.4326 1.62475 -2.5599 2.43687 -1.1232 0.8092 -2.52289 1.491 -4.0673 1.491 -1.5444 0 -2.9441 -0.6818 -4.0673 -1.491C1.80544 9.69698 0.913028 8.72515 0.37279 8.07223L0.36828 8.0667C0.127025 7.7665 0 7.38607 0 7.00006c0 -0.38602 0.127025 -0.76644 0.36828 -1.06664l0.00451 -0.00553c0.540238 -0.65293 1.43265 -1.62475 2.55991 -2.4369ZM7 9.25c1.24264 0 2.25 -1.00736 2.25 -2.25S8.24264 4.75 7 4.75 4.75 5.75736 4.75 7 5.75736 9.25 7 9.25Z" clip-rule="evenodd" stroke-width="1"></path></g></svg></a>
@can('administrador')
<form action="{{route('coordinador.destroy',$value)}}" method="post">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn text-success"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14" id="Recycle-Bin-2--Streamline-Core" height="14" width="14"><desc>Recycle Bin 2 Streamline Icon: https://streamlinehq.com</desc><g id="recycle-bin-2--remove-delete-empty-bin-trash-garbage"><path id="Subtract" fill="#000000" fill-rule="evenodd" d="M5.76256 2.01256C6.09075 1.68437 6.53587 1.5 7 1.5c0.46413 0 0.90925 0.18437 1.23744 0.51256 0.20736 0.20737 0.35731 0.46141 0.43961 0.73744h-3.3541c0.0823 -0.27603 0.23225 -0.53007 0.43961 -0.73744ZM3.78868 2.75c0.10537 -0.67679 0.42285 -1.30773 0.91322 -1.798097C5.3114 0.34241 6.13805 0 7 0c0.86195 0 1.6886 0.34241 2.2981 0.951903 0.49037 0.490367 0.8079 1.121307 0.9132 1.798097H13c0.4142 0 0.75 0.33579 0.75 0.75 0 0.41422 -0.3358 0.75 -0.75 0.75h-1v8.25c0 0.3978 -0.158 0.7794 -0.4393 1.0607S10.8978 14 10.5 14h-7c-0.39783 0 -0.77936 -0.158 -1.06066 -0.4393C2.15804 13.2794 2 12.8978 2 12.5V4.25H1c-0.414214 0 -0.75 -0.33578 -0.75 -0.75 0 -0.41421 0.335786 -0.75 0.75 -0.75h2.78868ZM5 5.87646c0.34518 0 0.625 0.27983 0.625 0.625V10.503c0 0.3451 -0.27982 0.625 -0.625 0.625s-0.625 -0.2799 -0.625 -0.625V6.50146c0 -0.34517 0.27982 -0.625 0.625 -0.625Zm4.625 0.625c0 -0.34517 -0.27982 -0.625 -0.625 -0.625s-0.625 0.27983 -0.625 0.625V10.503c0 0.3451 0.27982 0.625 0.625 0.625s0.625 -0.2799 0.625 -0.625V6.50146Z" clip-rule="evenodd" stroke-width="1"></path></g></svg></button>
    </form>
@endcan
</div>
