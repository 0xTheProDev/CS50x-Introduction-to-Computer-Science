/**
 * resize.c
 *
 * Computer Science 50
 * Problem Set 4
 *
 * Author: Progyan
 */

#include <stdio.h>
#include <stdlib.h>

#include "bmp.h"

int main(int argc, char* argv[])
{
    // ensure proper usage
    if (argc != 4)
    {
        printf("Usage: ./resize n infile outfile\n");
        return 1;
    }

    // remember filenames
    unsigned int n = atoi(argv[1]);
    if (!n || n > 100)
    {
        printf("n must belong to [1, 100]\n");
        return 2;
    }
    char* infile = argv[2];
    char* outfile = argv[3];

    // open input file 
    FILE* inptr = fopen(infile, "r");
    if (inptr == NULL)
    {
        printf("Could not open %s.\n", infile);
        return 3;
    }

    // open output file
    FILE* outptr = fopen(outfile, "w");
    if (outptr == NULL)
    {
        fclose(inptr);
        fprintf(stderr, "Could not create %s.\n", outfile);
        return 4;
    }

    // read infile's BITMAPFILEHEADER
    BITMAPFILEHEADER bfi, bfo;
    fread(&bfi, sizeof(BITMAPFILEHEADER), 1, inptr);

    // read infile's BITMAPINFOHEADER
    BITMAPINFOHEADER bin, bio;
    fread(&bin, sizeof(BITMAPINFOHEADER), 1, inptr);

    // ensure infile is (likely) a 24-bit uncompressed BMP 4.0
    if (bfi.bfType != 0x4d42 || bfi.bfOffBits != 54 || bin.biSize != 40 || 
            bin.biBitCount != 24 || bin.biCompression != 0)
    {
        fclose(outptr);
        fclose(inptr);
        fprintf(stderr, "Unsupported file format.\n");
        return 5;
    }

    // determine padding for scanlines
    int in_padding =  (4 - (bin.biWidth * sizeof(RGBTRIPLE)) % 4) % 4;

    // copy and modify BITMAPINFOHEADER
    bio = bin;
    bio.biWidth = n * bin.biWidth;
    bio.biHeight = n * bin.biHeight;
    int op_padding =  (4 - (bio.biWidth * sizeof(RGBTRIPLE)) % 4) % 4;
    bio.biSizeImage = bio.biWidth * bio.biHeight * sizeof(RGBTRIPLE)
        + op_padding * abs(bio.biHeight);

    // copy and modify BITMAPFILEHEADER
    bfo = bfi;
    bfo.bfSize = 54 + bio.biWidth * abs(bio.biHeight) * 3 + 
        abs(bio.biHeight) * op_padding;
    bio.biSizeImage = ((((bio.biWidth * bio.biBitCount) + 31) & ~31) / 8)
        * abs(bio.biHeight);

    // write outfile's BITMAPFILEHEADER
    fwrite(&bfo, sizeof(BITMAPFILEHEADER), 1, outptr);

    // write outfile's BITMAPINFOHEADER
    fwrite(&bio, sizeof(BITMAPINFOHEADER), 1, outptr);

    RGBTRIPLE triple;

    // iterate over infile's scanlines
    for (int i = 0, biHeight = abs(bin.biHeight); i < biHeight; i++)
    {
        // Iterating n times
        for (int p = 0; p < n; p++)
        {
            // iterate over pixels in scanline
            for (int j = 0; j < bin.biWidth; j++)
            {
                // read RGB triple from infile
                fread(&triple, sizeof(RGBTRIPLE), 1, inptr);
                // iterating n times
                for (int q = 0; q < n; q++)
                {
                    fwrite(&triple, sizeof(RGBTRIPLE), 1, outptr);
                }
            }
            // skip over padding, if any
            fseek(inptr, in_padding, SEEK_CUR);
            // writting to outfile
            for (int k = 0; k < op_padding; k++)
                fputc(0x00, outptr);

            fseek(inptr, - (bin.biWidth * 3 + in_padding), SEEK_CUR);
        }
        fseek(inptr, (bin.biWidth * 3 + in_padding), SEEK_CUR);
    }

    // close infile
    fclose(inptr);

    // close outfile
    fclose(outptr);

    // that's all folks
    return 0;
}
