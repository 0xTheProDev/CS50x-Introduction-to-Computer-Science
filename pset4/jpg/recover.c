/**
 * recover.c
 *
 * Computer Science 50
 * Problem Set 4
 *
 * Recovers JPEGs from a forensic image.
 */

#include <stdio.h>
#include <stdint.h>
#include <string.h>
typedef uint8_t BYTE;

int main(void)
{
    // Opening raw file
    FILE *fin = fopen("./card.raw", "rb");
    if (fin == NULL)
    {
        fprintf(stderr, "Some error occured while reading the file.\n");
        return 1;
    }
    FILE *fout = NULL;

    // Creating samples and structures
    const BYTE jpg[] = {0xff, 0xd8, 0xff};
    //jpg2[] = {0xff, 0xd8, 0xff};
    BYTE sig[4] = {0};
    BYTE buffer[512] = {0};

    // State variables
    int i = 0;
    char title[10];

    // Reading from file
    while (fread(&buffer, sizeof(buffer), 1, fin) > 0)
    {
        // Copying first four bytes
        memcpy(sig, buffer, sizeof(sig));
        // If I got a new file
        if (!memcmp(jpg, sig, sizeof(jpg)) && 
                (sig[3] & 11100 || sig[3] & 11101))
        {
            // Close the previous one if opened
            if (fout)
            {
                fclose(fout);
            }
            // Open a new one
            sprintf(title, "%03d.jpg", i++);
            fout = fopen(title, "wb");
        }
        // Write into output file
        if (fout)
        {
            fwrite(&buffer, sizeof(buffer), 1, fout);
        }
    }

    // Closing file connections
    if (fout)
    {
        fclose(fout);
    }
    fclose(fin);

    return 0;
}
