function showFallbackModal() {
  Swal.fire({
    title: '⚡ No Perfect Match Found',
    html: `
      <p style="margin: 0; color: #444; font-size: 15px;">
        Based on your selections, no strong position match was found.<br>
        You can improve your results by selecting more subjects or skills.
      </p>
    `,
    showCancelButton: true,
    reverseButtons: true,
    cancelButtonText: 'Skip, Maybe Later',
    confirmButtonText: '🚀 Yes, Improve My Selection',
    customClass: {
      popup: 'fallback-card',
      confirmButton: 'fallback-btn-confirm',
      cancelButton: 'fallback-btn-cancel'
    },
    background: '#fff',
    allowOutsideClick: false,
    allowEscapeKey: false
  }).then((result) => {
    if (result.isConfirmed) {
      // ✅ Go to fallback improvement page
      window.location.href = "/traintrack/fallback/improve";
    } else if (result.dismiss === Swal.DismissReason.cancel) {
      // ✅ Mark fallback as skipped (so we can show the "Improve" button later)
      localStorage.setItem("fallbackTriggered", "true");
    }
  });
}
